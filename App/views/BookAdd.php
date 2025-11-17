<?php

    //Se incluye con la conexión a la base de datos y todo lo necesario
    require_once '../../config/DBConnection.php';
    require_once '../models/BookModel.php';
    require_once '../models/AuthorModel.php';

    $DB = new Connection();
    $Conn = $DB->getConnection();

    //Se instancia un autor para mostrarlos
    $Author = new Author($Conn);

    $AuthorRead = $Author->Read();
    $Count = count($AuthorRead);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir un libro</title>
</head>
<body>
<form action="../controllers/BookController.php" method="post">

<h1>Rellene todos los campos</h1>
<hr>

<input type="hidden" name="Action" value="add">

<p>
    <label>Título:</label>
    <input type="text" name="" required>
</p>

<p>
    <label>Género:</label>
    <select name="Gender">
        <option>...</option>
        <option>Fantasía</option>
        <option>Terror</option>
        <option>Aventura</option>
        <option>Comedia</option>
    </select>
</p>

<p>
    <label>Año de publicación:</label>
    <input type="number" name="Year" required>
</p>

<p>
    <label>Autor:</label>
    <select name="Author">
    <option>...</option>
    <?php if($Count > 0){
        foreach($AuthorRead as $Row){
    ?>

        <option><?php echo htmlspecialchars($Row['nombre_autor']. " ". htmlspecialchars($Row['apellido_autor'])) ?></option>
    </select>
    
    <?php
    }
    }
    ?>

    <p>
        <input type="submit" value="Añadir">
    </p>

</p>
    
</form>
</body>
</html>