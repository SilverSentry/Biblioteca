<?php

require_once 'BaseModel.php';

//Clase extendida de BaseModel para la gestion de autor
    class Author extends BaseModel{

        public $Id;
        public $Name;
        public $Surname;

        private $Conn;

        public function __construct($DataBase){

        $this->Conn = $DataBase;

    }

    //Método para añadir un nuevo autor
    public function Create(){

        $Sql = "INSERT INTO autores (nombre_autor, apellido_autor) VALUES (?, ?)";

        $Stmt = $this->Conn->prepare($Sql);

        if ($Stmt->execute([$this->Name, $this->Surname])) {
   
            return true;

        } else{

            return false;

        }

    }

    //Método para obtener a los autores añadidos
    public function Read(){

        $Sql = "SELECT a.id_autor, a.nombre_autor, a.apellido_autor, l.titulo
            FROM autores a LEFT JOIN libros l ON a.id_autor = l.fk_id_autor 
            ORDER BY a.nombre_autor";

        $Stmt = $this->Conn->prepare($Sql);

        $Stmt->execute();

        return $Stmt->fetchAll();

    }

    //Método para leer los datos de un único autor
    public function ReadSingle($IdAuthor) {

    //Consulta SQL para obtener un solo registro por id
    $Sql = "SELECT * FROM autores WHERE id_autor = :id LIMIT 1";

    $Stmt = $this->Conn->prepare($Sql);

    $Stmt->bindParam(':id', $IdAuthor);

    $Stmt->execute();

    return $Stmt->fetch(PDO::FETCH_ASSOC);

    }

    //Método para actualizar los datos del autor
    public function Update($Id, $Name, $Surname){

        $Sql = "UPDATE autores SET nombre_autor = :nombre, apellido_autor = :apellido WHERE id_autor = :id";

        $Stmt = $this->Conn->prepare($Sql);

        $IdClean = htmlspecialchars(($Id));
        $NameClean = htmlspecialchars(($Name));
        $SurnameClean = htmlspecialchars(($Surname));

        //Se vincula los parámetros a la sentencia
        $Stmt->bindParam(':id', $IdClean);
        $Stmt->bindParam(':nombre', $NameClean);
        $Stmt->bindParam(':apellido', $SurnameClean);

        if($Stmt->execute()){

            return true;

        }else {

            return false;

        }

    }

    public function Delete($Id){

        $Sql = "DELETE FROM autores WHERE id_autor = :id";

        $Stmt = $this->Conn->prepare($Sql);

        $IdClean = htmlspecialchars(($Id));

        //Se vincula el parámetro a la sentencia
        $Stmt->bindParam(':id', $IdClean);
        
        if($Stmt->execute()){

            return true;

        }else {

            return false;

        }

    }

}

?>