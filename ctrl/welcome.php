<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/user.php';


class Welcome extends Ctrl
{
    function do(): void
    {
        $_SESSION['user'] = [];
    }

    function renderView(): void
    {
        $args = $this->viewArgs;

        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/welcome.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/footer.php';
    }
    function getPageTitle(): string
    {
        return 'Welcome to BlaBlaBlog 
        <span id="welcome-sentence">The Blog that loves to BlaBla</span>';
    }
}

$ctrl = new Welcome();
$ctrl->execute();
