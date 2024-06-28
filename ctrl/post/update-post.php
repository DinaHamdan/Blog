<?php



require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/imgType.php';


class UpdateArticle extends Ctrl
{
    function do(): void
    {
        $idArticle = $_SESSION['post']['id'];
        $blogTitle = htmlspecialchars($_POST['post-title']);

        $blogContent = htmlspecialchars($_POST['create-post']);

        //Get user Id from session
        $userId = $_SESSION['user']['id'];
        echo ($_SESSION['user']);


        //Initier une session  d'un objet msg avec info et erreur comme objet
        $_SESSION['msg']['info'] = [];
        $_SESSION['msg']['error'] = [];

        //Créer un répertoire pour stocker les photos uploadé
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

        $png = Type::MY_IMG_PNG;
        $jpg = Type::MY_IMG_JPG;

        $listAcceptedFileTypes = [$png, $jpg];

        // Lis les informations saisies dans le formulaire
        $fileName = $_FILES['blogPhoto']['name'];
        // $fileSize = $_FILES['blogPhoto']['size'];

        //
        $fileTmpName  = $_FILES['blogPhoto']['tmp_name'];
        $fileType = $_FILES['blogPhoto']['type'];



        // Effectue différents tests sur les données saisies
        $isSupportedFileType = in_array($fileType, $listAcceptedFileTypes);
        if (!$isSupportedFileType) {
            echo 'is in accepted files';

            // Ajoute un flash-message
            $_SESSION['msg']['error'][] = 'le Post a pas eu être modifié, les seuls formats de fichier acceptés sont : ' . implode(',', $listAcceptedFileTypes);
        }
        if (true) {
            echo 'all good';
            //...filesize
        }

        $hasErrors = !empty($_SESSION['msg']['error']);
        if ($hasErrors) {
            echo 'has errors.';
            // Redirige vers le formulaire pour corrections


            header('Location: ' . '/ctrl/post/list-post-display.php');
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


        // Ajoute un flash-message
        $_SESSION['msg']['info'][] = 'Le Poste a été créé.';

        $binaryFile = fopen($fileTmpName, 'rb');
        $nameFile = basename($fileName);

        echo 'this is the binary file' .  $binaryFile;
        echo 'this is the name file' . $nameFile;


        $dateTime = date('Y-m-d h:i:s');
        // ("Y-m-d h:i:s")
        $isSucces = LibPost::updateArticle($idArticle, $blogTitle, $blogContent, $userId, $binaryFile, $nameFile, $dateTime);
    }

    function renderView(): void
    {
        $args = $this->viewArgs;
        header('Location: ' . '/ctrl/post/list-post-display.php');
    }


    function getPageTitle(): null
    {
        return null;
    }
}

$ctrl = new UpdateArticle();
$ctrl->execute();
