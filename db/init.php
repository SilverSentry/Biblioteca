<?php
//Archivo creado para crear la base de datos y sus tablas

//Se incluye la conexión a la base de datos, o al servidor
require_once '../config/DBConnection.php';

$DataBase = new Connection();
$Conn = $DataBase->getConnection();

//Se crea la base de datos si no existe
try {
    
    $Conn->exec("CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8 COLLATE utf8_general_ci");

    //Una vez creada, se selecciona para crear las tablas
    $Conn->exec("USE biblioteca");

    // Tabla autores
    $Sql = "CREATE TABLE IF NOT EXISTS autores (
        id_autor INT AUTO_INCREMENT PRIMARY KEY,
        nombre_autor VARCHAR(100) NOT NULL,
        apellido_autor VARCHAR(100) NOT NULL
    ) ENGINE=InnoDB;";

    $Conn->exec($Sql);

    // Tabla libros
    $Sql = "CREATE TABLE IF NOT EXISTS libros (
        id_libro INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(200) NOT NULL, 
        genero VARCHAR(100) NOT NULL,
        anio_publicacion YEAR,
        fk_id_autor INT,
        FOREIGN KEY (fk_id_autor) REFERENCES autores(id_autor) ON DELETE SET NULL
    ) ENGINE=InnoDB;";

    $Conn->exec($Sql);

     //Tabla usuarios
    $Sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id_usuario INT AUTO_INCREMENT PRIMARY KEY,
        nombre_usuario VARCHAR(100) NOT NULL,
        apellido_usuario VARCHAR(100) NOT NULL,
        contrasena VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB;";

    $Conn->exec($Sql);

    // Tabla préstamos
    $Sql = "CREATE TABLE IF NOT EXISTS prestamos (
        id_prestamo INT AUTO_INCREMENT PRIMARY KEY,
        fecha_prestamo DATE DEFAULT (CURRENT_DATE),
        fecha_devolucion DATE NULL,
        estado ENUM('prestado', 'devuelto') DEFAULT 'prestado',
        fk_id_libro INT NOT NULL,
        fk_id_usuario INT NOT NULL,
        FOREIGN KEY (fk_id_libro) REFERENCES libros(id_libro) ON DELETE CASCADE,
        FOREIGN KEY (fk_id_usuario) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE
    ) ENGINE=InnoDB;";

    $Conn->exec($Sql);

    echo "<h1>Base de datos 'biblioteca' creada o verificada con éxito.</h1>";
    echo "<a href='../index.php'>Volver al inicio</a>";

} catch (PDOException $e) {

    //Si llega haber un error, se mostrará
    die("Error al crear tablas: " . $e->getMessage());
}

?>