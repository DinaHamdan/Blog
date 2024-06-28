<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/user.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';


class ListPost extends Ctrl
{
    function do(): void
    {
        $listMember = LibUser::getAllUserProfile();
        $_SESSION['listUser'] = $listMember;
    
    }

    function renderView(): void
    {
        $args = $this->viewArgs;
        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/list-members-display.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/footer.php';
    }
    function getPageTitle(): string
    {
        return 'Members!';
    }
}

$ctrl = new ListPost();
$ctrl->execute();
