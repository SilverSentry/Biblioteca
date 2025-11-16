<?php

require_once '../config/DBConnection.php';

abstract class BaseModel{
    
    protected $DataBase; // <-- Debe ser inicializada
    
    public function __construct() {
        
        // La clave es que esta línea devuelva el objeto PDO, NO NULL
        $this->DataBase = Connection::getInstance()->getConnection();
    }

}

?>
