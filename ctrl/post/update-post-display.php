<?php



require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';

class UpdateArticleDisplay extends Ctrl
{
    function do(): void
    {
        $idArticle = $_GET['id'];
        $post = LibPost::getPost($idArticle);
        $_SESSION['post'] = $post;
    }

    function renderView(): void
    {
        $args = $this->viewArgs;

        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/post/update-post-display.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/footer.php';
    }


    function getPageTitle(): string
    {
        return 'Update your Post';
    }
}

$ctrl = new UpdateArticleDisplay();
$ctrl->execute();
