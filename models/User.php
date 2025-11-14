<?php

class User{

    private $Conn;

    //Atributos del usuario
    public $Id;
    public $Name;
    public $Surname;
    public $Email;
    public $Password;

    public function __construct($DataBase){

        $this->Conn = $DataBase;

    }

        //Método para verificar si el usuario ya existe
        public function EmailExists($Email){

        $sql = "SELECT COUNT(*) FROM usuarios WHERE email_usuario = ?";

        $stmt = $this->Conn->prepare($sql);

        $stmt->execute([$Email]);
        
        //Si el conteo es mayor que 0, el email existe
        return $stmt->fetchColumn() > 0;

    }

    //Método para registrar un nuevo usuario
    public function Create(){

        $Sql = "INSERT INTO usuarios (nombre_usuario, apellido_usuario, email_usuario, contraseña_usuario) VALUES (?, ?, ?, ?)";

        $Stmt = $this->Conn->prepare($Sql);

        if ($Stmt->execute([$this->Name, $this->Surname, $this->Email, $this->Password])) {
   
            return true;

        } else{

            return false;

        }

    }

}

?>