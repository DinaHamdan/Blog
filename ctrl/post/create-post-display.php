<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/role.php';

class PostDisplay extends Ctrl
{
    function do(): void
    {
        $codeRole = $_SESSION['user']['codeRole'];
        $admin = Role::ADMIN;
        if ($codeRole != $admin) {
            //If not go back to loging page

            header('Location: ' . '/ctrl/post/list-post-display.php');
            exit;
        };
        //  else {
        //     // head towards page where we can read post and put comments SHOULD BE CHANGED LATER

        //     header('Location: ' . '/ctrl/post/create-post-display.php');
        //     exit;
        // };
    }
    function renderView(): void
    {
        $args = $this->viewArgs;

        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/post/create-post-display.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/footer.php';
    }
    function getPageTitle(): string
    {
        return 'Write a post';
    }
}

$ctrl = new PostDisplay();
$ctrl->execute();
