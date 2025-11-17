<?php

//Se incluye con la conexión a la base de datos y el modelo autor
require_once '../../config/DBConnection.php';
require_once '../models/AuthorModel.php';

//Se crea una instancia Connection para obtener esa conexión
$DataBase = new Connection();
$Conn = $DataBase->getConnection();

//Se instancia un autor para realizar las acción de mostrar
$Author = new Author($Conn);

$AuthorRead = $Author->Read();
$Count = count($AuthorRead);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de autores</title>
</head>
<body>

    <h2>Lista de autores</h2>

<?php

if($Count > 0){

?>

    <table border='1'>

    <thead>
        <tr>
            <th>Nombre</th>
            <th>Libro</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

    <?php
    
        foreach($AuthorRead as $Row){

    ?>

        <tr>
            <td><?php echo htmlspecialchars($Row['nombre_autor'])." ". htmlspecialchars($Row['apellido_autor']); ?></td>
            <td><?php echo htmlspecialchars($Row['titulo'] ?? 'No tiene libros asociados'); ?></td>

            <td>
                <a href="AuthorEdit.php?id=<?php echo htmlspecialchars($Row['id_autor']); ?>">
                    <button>Editar</button>
                </a>

                <form action="../controllers/AuthorController.php" method="POST">
                    <input type="hidden" name="Action" value="delete">
                    <input type="hidden" name="AuthorDelete" value="<?php echo htmlspecialchars($Row['id_autor']); ?>">
                
                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este autor?');">Eliminar</button>
                </form>
            </td>   

        </tr>
       <?php
        }
       ?>
        
    </tbody>

</table>

<?php

}else {

    echo "<h1>No hay autores disponibles</h1>";

}

?>

<p>
<a href="AuthorAdd.php"><button>Añadir</button></a>
</p>

<p>
<a href="../../index.php">Volver al inicio</a>
</p>

</body>
</html>