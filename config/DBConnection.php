<?php

//clase creada para la conexión a la base de datos
class Connection{

    private static $Instance = null; //Propiedad estática para la instancia única

    private $Host = "localhost";
    private $DbName = "biblioteca";
    private $User = "root";
    private $Pass = "";
    private $Conn;

    //método que establece la conexión a la base de datos
    public function getConnection(){

        $this->Conn = null;

    try{
        
        // primero se intentar conectar a la base de datos llamada 'biblioteca'
        $this->Conn = new PDO("mysql:host={$this->Host};dbname={$this->DbName};charset=utf8", $this->User, $this->Pass);

    }catch (PDOException $Exception) {
    
        // Si la base de datos no existe (Error 1049), se conecta al servidor sin base de datos
        if($Exception->getCode() == 1049) {

             try{

                $this->Conn = new PDO("mysql:host={$this->Host};charset=utf8", $this->User, $this->Pass);
             
            }catch(PDOException $Except) {

                die("Error al conectar al servidor MySQL: " . $Except->getMessage());

            }

        }else {

            //Mensaje si se da otro error de conexión
            die("Error de conexión desconocido: " . $Exception->getMessage());
        }

    }
    
    return $this->Conn;

}

//Método estático para obtener la única instancia
    public static function getInstance(){

        if(!self::$Instance) {

            self::$Instance = new Connection(); //Llama al constructor privado solo si es la primera vez
        }

        return self::$Instance;

    }

}

?>