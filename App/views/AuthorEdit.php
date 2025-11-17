<?php

//Se incluye con la conexión a la base de datos y el modelo autor
require_once '../../config/DBConnection.php';
require_once '../models/AuthorModel.php';

//Se crea una instancia Connection para obtener esa conexión
$Conn = new Connection();
$DataBase = new Connection();
$Conn = $DataBase->getConnection();

// Se instancia un autor para realizar la acción de lectura
$Author = new Author($Conn);

// Verifica si el parámetro id está presente en la URL
if (isset($_GET['id'])) {

    $IdAuthor = $_GET['id'];

    $AuthorData = $Author->ReadSingle($IdAuthor);
    
    //Verifica si se encontraron datos para ese id
    if(!$AuthorData){

        //Se redirige si el id es válido pero el autor no existe
        header('Location: ShowAuthors.php?status=error_not_found');
        exit;

    }

}else {

    //Se redirige si el ID no se proporcionó en la URL
    header('Location: ShowAuthor.php?status=error_no_id');
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar autor</title>
</head>
<body>
<form method="POST" action="../controllers/AuthorController.php">

<h1>Actualizar información del Autor</h1>

    <input type="hidden" name="Action" value="update">
    <input type="hidden" name="IdAuthor" value="<?php echo $AuthorData['id_autor']; ?>">
    
    <p>
        <label>Nombre:</label>
        <input type="text" name="Name" value="<?php echo htmlspecialchars($AuthorData['nombre_autor']); ?>">
    </p>

    <p>
        <label>Apellido:</label>
        <input type="text" name="Surname" value="<?php echo htmlspecialchars($AuthorData['apellido_autor']); ?>">
    </p>

    <button type="submit">Actualizar Autor</button>

</form>
</body>
</html>