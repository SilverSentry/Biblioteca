<?php

require_once 'BaseModel.php';

//Clase creada para la gestion de libros
    class Book extends BaseModel{

        public $Id;
        public $Title;
        public $YearOfPublication;
        public $Gender;

        private $Conn;

        public function __construct($DataBase){

        $this->Conn = $DataBase;

    }

    //Método para registrar un nuevo libro
    public function Create(){

        $Sql = "INSERT INTO libros (titulo, anio_publicacion, genero) VALUES (?, ?, ?, ?)";

        $Stmt = $this->Conn->prepare($Sql);

        if ($Stmt->execute([$this->Title, $this->YearOfPublication, $this->Gender])) {
   
            return true;

        } else{

            return false;

        }

    }

    //Método para obtener los libros con su autor
    public function Read(){

        $Sql = "SELECT l.titulo, l.genero, l.anio_publicacion, a.nombre_autor, a.apellido_autor 
            FROM libros l LEFT JOIN autores a ON l.fk_id_autor = a.id_autor 
            ORDER BY l.titulo";

        $Stmt = $this->Conn->prepare($Sql);

        $Stmt->execute();

        return $Stmt->fetchAll();

    }

    //Método para actualizar los datos del libro
    public function Update(){

        

    }

}

?>