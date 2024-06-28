<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/styles.css">
    <title><?= $args['pageTitle'] ?></title>
</head>


<body>
    <header>
        <nav id="navigation-bar">
            <p>BlaBlaBlog.</p>
            <ul>
                <?php
                if ($args['session']['user'] != null) { ?>

                    <li><a href='/ctrl/welcome.php'>HomePage</a></li>
                    <li><a href='/ctrl/logout.php'>Logout</a></li>
                    <li><a href='/ctrl/list-members.php'>Members</a></li>
                    <?php if (($args)['session']['user']['codeRole'] == 'ADM') { ?>
                        <li><a href='/ctrl/post/list-post-display.php'>Posts</a></li>
                        <li><a href='/ctrl/post/create-post-display.php'>Write Posts</a></li>
                    <?php  } ?>

                <?php   } else { ?>
                    <li><a href='/ctrl/welcome.php'>HomePage</a></li>
                    <li><a href='/ctrl/login/login-display.php'>Login</a></li>
                    <li><a href='/ctrl/inscription/create-display.php'>Register</a></li>

                <?php } ?>

            </ul>
        </nav>
        <div id="header-container">
            <h1><?= $args['pageTitle'] ?></h1>

            <div id="listWarning">
                <?php if (!empty($args['session']['msg']['incorrect'])) { ?>

                    <div class="info">

                        <?php foreach ($args['session']['msg']['incorrect'] as $inco) { ?>
                            <p><?= $inco ?></p>
                        <?php } ?>

                    </div>
                <?php } ?>

                <?php if (!empty($args['session']['msg']['unexisting'])) { ?>

                    <div class="error">

                        <?php foreach ($args['session']['msg']['unexisting'] as $unexisting) { ?>
                            <p><?= $unexisting ?></p>
                        <?php } ?>

                    </div>
                <?php } ?>
            </div>
            <?php unset($_SESSION['msg']) ?>

        </div>
    </header>