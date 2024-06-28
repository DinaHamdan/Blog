<main>
    <div id="welcome-container">
        <div>
            <h2>Do you have an account? if yes Login</h2>
            <a class="welcome" href="/ctrl/login/login-display.php">Login</a>
        </div>
        <div>
            <h2>If not create an account!</h2>
            <a class="welcome" href="/ctrl/inscription/create-display.php">Create an account</a>
        </div>
    </div>
    <?php

    // If member is logged in they can see the other members and the posts
    if ($args['session']['user'] != null) { ?>
        <section id="members">
            <!-- <h2>Members</h2> -->
            <img src="" alt="">
            <img src="" alt="">
            <img src="" alt="">

        </section>
        <section id="article">
            <div id="articl-container">
                <p id=""></p>
                <img src="" alt="">
            </div>


        </section>

    <?php   } else { ?>

        </section>
        <section id="article">
            <div id="articl-container">
                <p id=""></p>
                <img src="" alt="">
            </div>


        <?php } ?>


</main>