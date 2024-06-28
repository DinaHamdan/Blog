<main>



    <div id="list-member-container">


        <?php foreach ($args['session']['listUser'] as $args['session']['oneUser']) { ?>
            <div id="member-container">
                <p><?= $args['session']['oneUser']['email'] ?></p>
                <img id="profile-photo" src="data:image/png;base64,<?= base64_encode($args['session']['oneUser']['avatar']) ?>" alt="user-Avatar">
                <p id="member-description">About me : <?= $args['session']['oneUser']['description'] ?></p>
                <?php if ($args['session']['user']['codeRole'] == 'ADM') { ?>
                    <p> <a href="/ctrl/remove-member.php?id=<?= $args['session']['oneUser']['id'] ?>">Remove</a></p>

                <?php  } ?>
            </div>
        <?php } ?>

    </div>

</main>