<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/role.php';

interface CtrlI
{
    function isUserLogged(): bool;
    function hasRole(string $role);
    function renderView(): void;
    function getPageTitle(): ?string;
}
