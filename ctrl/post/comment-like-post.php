<?php



require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';

class CreateComment extends Ctrl
{
    function do(): void
    {


        // $idArticle = $_SESSION['post']['id'];
        $idArticle = htmlspecialchars($_POST['hiddenId']);
        $userId = $_SESSION['user']['id'];
        $commentContent = htmlspecialchars($_POST['comment']);


        $dateTime = date('Y-m-d h:i:s');
        $comment = LibPost::createComment($commentContent, $userId,  $idArticle, $dateTime);
    }

    function renderView(): void
    {
        $args = $this->viewArgs;
        header('Location: ' . '/ctrl/post/list-post-display.php');
        //For now
        // header('Location: ' . '/ctrl/post/list-comment-like-post-display.php');
    }


    function getPageTitle(): null
    {
        return null;
    }
}

$ctrl = new CreateComment();
$ctrl->execute();
