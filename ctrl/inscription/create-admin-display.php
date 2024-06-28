<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';


class Createdisplay extends Ctrl
{
    function do(): void
    {
    }
    function renderView(): void
    {
        $args = $this->viewArgs;
        //Rends la vue
        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/inscription/create-admin-display.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/footer.php';
    }
    function getPageTitle(): string
    {
        return 'Register as an admin';
    }
}

$ctrl = new Createdisplay();
$ctrl->execute();
