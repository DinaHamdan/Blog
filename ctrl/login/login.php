
<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ctrl/ctrl.php';


class Login extends Ctrl
{
    function do(): void
    {

        // Read login info entered by user
        $userInfo = [];
        //To protect from injections
        $userInfo['email'] = htmlspecialchars($_POST['email']);
        $userInfo['pass'] = htmlspecialchars($_POST['pass']);
        $password = $userInfo['pass'];

        // List all user components using their email as id
        $user = LibUser::getUser($userInfo['email']);
        // var_dump($user);
        if ($user != null) {

            if (password_verify($password, $user['pass'])) {
                $_SESSION['user'] = $user;

                header('Location: ' . '/ctrl/post/create-post-display.php');
                exit;
            } else {
                $_SESSION['msg']['incorrect'] = [];

                $_SESSION['msg']['incorrect'][]  = 'Incorrect Login';
                header('Location: ' .  '/ctrl/login/login-display.php');
                exit;
            };
        } else {

            $_SESSION['msg']['unexisting'] = [];

            $_SESSION['msg']['unexisting'][] = 'User account not found.';

            header('Location: ' .  '/ctrl/login/login-display.php');
            exit;
        };
    }
    function renderView(): void
    {
        $args = $this->viewArgs;

        // include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php';
        // include $_SERVER['DOCUMENT_ROOT'] . '/view/login/login-display.php.php';
        // include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/footer.php';
    }
    function getPageTitle(): string
    {
        return 'Hello user, Please Login.';
    }
}

$ctrl = new Login();
$ctrl->execute();
