<?php



require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';

class DeleteUser extends Ctrl
{
    function do(): void
    {
        $idUser = $_GET['id'];
        $idComment = $_GET['id'];

        $isSucces = LibUser::deleteComment($idComment);
        $isSucces = LibPost::deleteLikesUser($idUser);
        $isSucces = LibUser::deleteUser($idUser);
    }

    function renderView(): void
    {
        $args = $this->viewArgs;
        header('Location: ' . '/ctrl/list-members.php');
    }


    function getPageTitle(): null
    {
        return null;
    }
}

$ctrl = new DeleteUser();
$ctrl->execute();
