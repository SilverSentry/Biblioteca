<?php

//clase creada para la conexión a la base de datos
class Connection{

    private $Host = "localhost";
    private $DbName = "biblioteca";
    private $User = "root";
    private $Pass = "";
    private $Conn;

    //método que establece la conexión a la base de datos
    public function getConnection(){

        $this->Conn = null;

    try {
        
        $this->Conn = new PDO("mysql:host={$this->Host};dbname={$this->DbName};charset=utf8", $this->User, $this->Pass);

    } catch (PDOException $Exception) {
    
        echo "Error de conexión: ". $Exception->getMessage();

    }

    return $this->Conn;

}

}

?>