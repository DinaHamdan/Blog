<?php



require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';

class DeleteArticle extends Ctrl
{
    function do(): void
    {
        $isLogged = $this->isUserLogged();
        $isGranted = $this->hasRole(Role::ADMIN);
        $idArticle = $_GET['id'];
        $isSucces = LibPost::deleteComments($idArticle);
        $isSucces = LibPost::deleteLikes($idArticle);
        $isSucces = LibPost::deleteArticle($idArticle);
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

$ctrl = new DeleteArticle();
$ctrl->execute();
