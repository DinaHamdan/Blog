<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/CtrlI.php';

abstract class Ctrl implements CtrlI

{
    protected array $viewArgs = [];

    protected abstract function do(): void;

    public function execute(): void
    {
        session_start();
        $this->do();

        $this->viewArgs['pageTitle'] = $this->getPageTitle();
        $this->viewArgs['session'] = $_SESSION;

        $this->renderView();
    }

    public function isUserLogged(): bool
    {
        return $_SESSION['user'] != null;
    }
    public function hasRole(string $role)
    {
        return $this->isUserLogged() && $_SESSION['user']['codeRole'] == $role;
    }
}
