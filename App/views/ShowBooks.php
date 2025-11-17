<?php

//Se incluye tanto la conexión como el modelo libro
require_once '../../config/DBConnection.php';
require_once '../models/BookModel.php';

$DataBase = new Connection();
$Conn = $DataBase->getConnection();

$Book = new Book($Conn);

$BookRead = $Book->Read();
$Count = count($BookRead);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>Lista de libros</h2>

<?php

if($Count > 0){

?>

    <table border='1'>

    <thead>
        <tr>
            <th>Título</th>
            <th>Género</th>
            <th>Año de publicación</th>
            <th>Autor</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

    <?php
    
        foreach($BookRead as $Row){

    ?>

        <tr>
            <td><?php echo htmlspecialchars($Row['titulo']); ?></td>
            <td><?php echo htmlspecialchars($Row['genero']); ?></td>
            <td><?php echo htmlspecialchars($Row['anio_publicacion']); ?></td>
            <td><?php echo htmlspecialchars($Row['nombre_autor']). " ". htmlspecialchars($Row['apellido_autor']); ?></td>
            <td><button>Editar</button> <button>Eliminar</button></td>
        </tr>

       <?php } ?>
        
    </tbody>

</table>

<?php

}else {

    echo "<h1>No hay libros disponibles</h1>";

}

?>

<p>
<a href="BookAdd.php">Añadir</a>
</p>

<p>
<a href="../../index.php">Volver al inicio</a>
</p>

</body>
</html>