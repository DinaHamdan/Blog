<?php



require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';

class CreateLike extends Ctrl
{
    function do(): void
    {
        $isLogged = $this->isUserLogged();
        $isGranted = $this->hasRole(Role::PUBLIC);

        $idArticle = $_GET['id'];
        $idUser = $_SESSION['user']['id'];
        // var_dump($_SESSION['user']);


        if ((LibPost::hasAlreadyLiked($idUser, $idArticle)) == false) {

            $dateTime = date('Y-m-d h:i:s');
            LibPost::like($idUser, $idArticle, $dateTime);
        }
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

$ctrl = new CreateLike();
$ctrl->execute();
