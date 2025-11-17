<?php

require_once '../models/DBConnection.php';
require_once '../models/User.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $Name = $_POST['Name'] ?? '';
    $Surname = $_POST['Surname'] ?? '';
    $Email = $_POST['Email'] ?? '';
    $Password = password_hash($_POST['Password'] ?? '', PASSWORD_DEFAULT);


    $DataBase = new Connection();

    $Conn = $DataBase->getConnection();


    $User = new User($Conn);

    if($User->EmailExists($Email)){

        header("location: ../views//UserAlreadyExists.php");
        exit;

     }else{

    $User->Name = $Name;
    $User->Surname = $Surname;
    $User->Email = $Email;
    $User->Password = $Password;

    if($User->Create()){

        echo "Usuario registrado";

    } else{

        echo "El usuario no se registró.";

    }

}

}

?>