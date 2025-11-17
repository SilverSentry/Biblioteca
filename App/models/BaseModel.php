<?php

//Se incluye la conexión a la base de datos
require_once '../../config/DBConnection.php';

//Se crea una clase abstracta para que no pueda ser instanciada
//Pero se utiliza como plantilla o molde para otras clases
abstract class BaseModel{
    
    protected $DataBase; // <-- Debe ser inicializada
    
    public function __construct() {
        
        //Esta línea devuelve el objeto PDO
        $this->DataBase = Connection::getInstance()->getConnection();
    }

}

?>
