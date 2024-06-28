<?php

//Create user - gather data entered by user -redirect towards login page

//establish a connection to database and libray of functions
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/imgType.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';




class Create extends Ctrl
{
    function do(): void
    {
        //Gather data entered by user 
        $user = [];
        $user['email'] = htmlspecialchars($_POST['email']);
        $user['description'] = htmlspecialchars($_POST['description']);
        $user['passClear'] = htmlspecialchars($_POST['pass']);
        $user['idRole'] = 2;


        //Password default uses the bcrypt algorithm to create the hash  the length of the result 
        //from using this identifier can change over time. Therefore, it is recommended to store the result 
        //in a database column that can expand beyond 60 characters (255 characters would be a good choice).
        //$password = password_hash($user['passClear'], PASSWORD_DEFAULT);

        //Password bcrypt Use the CRYPT_BLOWFISH algorithm to create the hash. This will produce a standard crypt() 
        //compatible hash using the "$2y$" identifier. The result will always be a 60 character string, or false on failure. 
        $password = password_hash($user['passClear'], PASSWORD_BCRYPT);


        // var_dump($password);
        $user['passHash'] = $password;

        // var_dump($user['password']);

        //Create an avatar option

        //Initier une session  d'un objet msg avec info et erreur comme objet
        $_SESSION['msg']['info'] = [];
        $_SESSION['msg']['error'] = [];

        //Créer un répertoire pour stocker les photos uploadé
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

        $png = Type::MY_IMG_PNG;
        $jpg = Type::MY_IMG_JPG;

        $listAcceptedFileTypes = [$png, $jpg];
        // Lis les informations saisies dans le formulaire
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];

        //
        $fileTmpName  = $_FILES['file']['tmp_name'];
        $fileType = $_FILES['file']['type'];

        echo 'this is the temporary file name' . $fileTmpName;
        echo 'this is the file type' . $fileType;
        echo 'this is the file name' . $fileName;
        echo 'this is the file size' . $fileSize;

        // Effectue différents tests sur les données saisies
        $isSupportedFileType = in_array($fileType, $listAcceptedFileTypes);
        if (!$isSupportedFileType) {
            // echo 'is in accepted files';

            // Ajoute un flash-message
            $_SESSION['msg']['error'][] = 'The only acceptable photo formats are the following: ' . implode(',', $listAcceptedFileTypes);
        }
        if (true) {
            // echo 'all good';
            //...filesize
        }

        $hasErrors = !empty($_SESSION['msg']['error']);
        if ($hasErrors) {
            //echo 'has errors.';
            // Redirige vers le formulaire pour corrections
            header('Location: ' . '/ctrl/inscription/create-display.php');
            exit();
        }

        // Redimensionne l'image
        // WARN! sudo apt install php-gd
        // $imgOriginal;

        if ($fileType == $png) {
            $imgOriginal = imagecreatefrompng($fileTmpName);
        }
        if ($fileType == $jpg) {
            $imgOriginal = imagecreatefromjpeg($fileTmpName);
        }
        $img = imagescale($imgOriginal, 200);
        imagepng($img, $fileTmpName);

        //Insert avatar into avatar table
        //$isSuccess = LibProfile::createAvatar($fileTmpName);




        $binaryFile = fopen($fileTmpName, 'rb');
        $nameFile = basename($fileName);

        echo 'this is the binary file' .  $binaryFile;
        echo 'this is the name file' . $nameFile;
        //Create User
        $isSuccess = LibUser::createUser($user['email'], $user['description'], $user['passHash'], $user['passClear'], $user['idRole'], $binaryFile, $nameFile);
        // Ajoute un flash-message
        if ($isSuccess) {
            $_SESSION['msg']['info'][] = 'Your profile has been created successfully.';
        }
        // Copie aussi le fichier d'avatar dans un répertoire
        //TODO //it's not working 
        $uploadPath = $uploadDirectory . basename($fileName);
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        // Redirige vers la page de login
        header('Location: ' . '/ctrl/login/login-display.php');
        //var_dump($_SESSION['msg']);
    }

    function renderView(): void
    {
        $args = $this->viewArgs;

        // include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php';
        // include $_SERVER['DOCUMENT_ROOT'] . '/view/login/login-display.php';
        // include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/footer.php';
    }
    function getPageTitle(): null
    {
        return null;
    }
}



$ctrl = new Create();
$ctrl->execute();
