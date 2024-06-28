<?php



require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/imgType.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';


class CreatePost extends Ctrl
{
    function do(): void
    {
        // Read blog contententered by user
        //Post content from formulaire
        $blogTitle = htmlspecialchars($_POST['post-title']);
        $blogContent = htmlspecialchars($_POST['create-post']);

        //Get user Id from session
        $userId = $_SESSION['user']['id'];
        // echo ($_SESSION['user']);


        //Initier une session  d'un objet msg avec info et erreur comme objet
        $_SESSION['msg']['info'] = [];
        $_SESSION['msg']['error'] = [];

        //Create a directory to save uploaded photos
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

        $png = Type::MY_IMG_PNG;
        $jpg = Type::MY_IMG_JPG;

        $listAcceptedFileTypes = [$png, $jpg];

        //Read information seized in the create a blog form
        $fileName = $_FILES['blogPhoto']['name'];
        $fileSize = $_FILES['blogPhoto']['size'];

        //
        $fileTmpName  = $_FILES['blogPhoto']['tmp_name'];
        $fileType = $_FILES['blogPhoto']['type'];


        // echo 'this is the temporary file name' . $fileTmpName;
        // echo 'this is the file type' . $fileType;
        // echo 'this is the file name' . $fileName;
        // echo 'this is the file size' . $fileSize;

        // Put in place several tests on the the uploaded photo to check if it has the right file type
        $isSupportedFileType = in_array($fileType, $listAcceptedFileTypes);
        if (!$isSupportedFileType) {
            echo 'is in accepted files';

            // Add a flash message
            $_SESSION['msg']['error'][] = 'Les seuls formats de fichier acceptés sont : ' . implode(',', $listAcceptedFileTypes);
        }
        if (true) {
            echo 'all good';
            //...filesize
        }

        $hasErrors = !empty($_SESSION['msg']['error']);
        if ($hasErrors) {
            echo 'has errors.';
            // Redirect towards the form to correct the photo upload
            header('Location: ' . '/ctrl/post/create-post-display.php');
            exit();
        }

        // Resize the photo
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


        // Ajoute un flash-message
        $_SESSION['msg']['info'][] = 'The blog has been created.';

        $binaryFile = fopen($fileTmpName, 'rb');
        $nameFile = basename($fileName);

        echo 'this is the binary file' .  $binaryFile;
        echo 'this is the name file' . $nameFile;


        $dateTime = date('Y-m-d h:i:s');
        // ("Y-m-d h:i:s")

        //Create Post
        $isSuccess = LibPost::createPost($blogTitle, $blogContent, $userId, $binaryFile, $nameFile, $dateTime);

        // Copy the image file into the photo directory
        $uploadPath = $uploadDirectory . basename($fileName);
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    }

    function renderView(): void
    {
        $args = $this->viewArgs;
        //add redirection

        header('Location: ' . '/ctrl/post/list-post-display.php');
    }


    function getPageTitle(): null
    {
        return null;
    }
}

$ctrl = new CreatePost();
$ctrl->execute();
