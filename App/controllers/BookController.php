<?php

//Se incluye tanto la conexión como el modelo autor
require_once '../../config/DBConnection.php';
require_once '../models/BookModel.php';

//Se inicializa la conexión y el modelo
    $DataBase = new Connection();
    $Conn = $DataBase->getConnection();
    $Book = new Book($Conn);

//Primera verificación solo procesar solicitudes POST
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Verifica y obtiene el tipo de acción
    $Action = $_POST['Action'] ?? '';

    function BookAdd($Book) {

    //Se obtienen los datos
    $Title = trim($_POST['Title'] ?? '');
    $Gender = trim($_POST['Gender'] ?? '');
    $YearPublication = trim($_POST['Year']);
    $Author = trim($_POST['Author']);

    if(empty($Title) || empty($Gender) || empty($YearPublication) || empty($Author)){

        header('Location: ../views/BookAdd.php?status=error_data_missing');
        exit;

    }

    //Se ejecuta la lógica del modelo
    if($Book->Create()){

        header('Location: ../views/ShowBook.php?status=success_added');

    }else {

        header('Location: ../views/BookAdd.php?status=error_db_add');

    }
    exit;
}

function BookUpdate($Book) {

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
    if($Book->Update($id, $Name, $Surname)){

        header('Location: ../views/ShowBook.php?status=success_updated');

    }else {

        header('Location: BookEdit.php?id='.$id.'&status=error_db_update');

    }
    exit;
}

function BookDelete($Book) {

    //Se obtiene el id
    //Se usa el nombre del campo del formulario de eliminación
    $Id = $_POST['AuthorDelete'] ?? 0;
    
    if(!is_numeric($Id) || $Id <= 0) {

        header('Location: ../views/ShowBook.php?status=error_invalid_id');
        exit;

    }

    //Se ejecuta la lógica del modelo
    if($Book->Delete($Id)){

        header('Location: ../views/ShowAuthors.php?status=success_deleted');

    }else {

        header('Location: ../views/ShowBook.php?status=error_db_delete');
        
    }
    exit;
}

//Se utiliza un switch para cada acción a realizar
    switch ($Action) {
        
        case 'add':
            BookAdd($Book);
            break;
            
        case 'update':
            BookUpdate($Book);
            break;
            
        case 'delete':
            BookDelete($Book);
            break;
            
        default:

            // Si no se especifica una acción válida, se redirige
            header('Location: ../views/ShowBooks.php?status=error_invalid_action');
            exit;
    }

}