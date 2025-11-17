<?php

//Se incluye tanto la conexión como el modelo autor
require_once '../../config/DBConnection.php';
require_once '../models/AuthorModel.php';

//Se inicializa la conexión y el modelo
    $DataBase = new Connection();
    $Conn = $DataBase->getConnection();
    $Author = new Author($Conn);

//Primera verificación solo procesar solicitudes POST
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Verifica y obtiene el tipo de acción
    $Action = $_POST['Action'] ?? '';

    function AuthorAdd($Author) {

    //Se obtienen los datos
    $Name = trim($_POST['Name'] ?? '');
    $Surname = trim($_POST['apellido_autor'] ?? '');

    if(empty($Name) || empty($Surname)){

        header('Location: ../views/AuthorAdd.php?status=error_data_missing');
        exit;

    }

    //Se ejecuta la lógica del modelo
    if($Author->Create($Name, $Surname)){

        header('Location: AuthorList.php?status=success_added');

    }else {

        header('Location: AuthorAdd.php?status=error_db_add');

    }
    exit;
}

function AuthorUpdate($Author) {

    //Se obtienen los datos, incluyendo el id
    $id = $_POST['IdAuthor'] ?? 0;
    $Name = trim($_POST['Name'] ?? '');
    $Surname = trim($_POST['Surname'] ?? '');

    //Se verifica que los campos no estén vacíos
    if(!is_numeric($id) || empty($Name) || empty($Surname)){

        header('Location: AuthorEdit.php?id='.$id.'&status=error_data_missing');
        exit;

    }

    //Se ejecuta la lógica del modelo
    if($Author->Update($id, $Name, $Surname)){

        header('Location: ../views/ShowAuthors.php?status=success_updated');

    }else {

        header('Location: AuthorEdit.php?id='.$id.'&status=error_db_update');

    }
    exit;
}

function AuthorDelete($Author) {

    //Se obtiene el id
    //Se usa el nombre del campo del formulario de eliminación
    $Id = $_POST['AuthorDelete'] ?? 0;
    
    if(!is_numeric($Id) || $Id <= 0) {

        header('Location: ../views/ShowAuthors.php?status=error_invalid_id');
        exit;

    }

    //Se ejecuta la lógica del modelo
    if($Author->Delete($Id)){

        header('Location: ../views/ShowAuthors.php?status=success_deleted');

    }else {

        header('Location: ../views/ShowAuthors.php?status=error_db_delete');
        
    }
    exit;
}

//Se utiliza un switch para cada acción a realizar
    switch ($Action) {
        
        case 'add':
            AuthorAdd($Author);
            break;
            
        case 'update':
            AuthorUpdate($Author);
            break;
            
        case 'delete':
            AuthorDelete($Author);
            break;
            
        default:

            // Si no se especifica una acción válida, se redirige
            header('Location: ../views/ShowAuthors.php?status=error_invalid_action');
            exit;
    }

}