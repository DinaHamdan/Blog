<footer>
    <div id="listMessage">
        <?php if (!empty($args['session']['msg']['info'])) { ?>

            <div class="info">
                <ul>
                    <?php foreach ($args['session']['msg']['info'] as $info) { ?>
                        <li><?= $info ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <?php if (!empty($args['session']['msg']['error'])) { ?>

            <div class="error">
                <ul>
                    <?php foreach ($args['session']['msg']['error'] as $error) { ?>
                        <li><?= $error ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>

    <?php unset($_SESSION['msg']) ?>
    <div id="footer-container">
        <p>BlaBlaBlog CopyRight &copy; - All rights reserved.</p>
        <div id="footer-img-container">
            <p>You can also find us on : </p>
            <img src="/asset/img/instagram.avif" alt="instagram-logo">
            <img src="/asset/img/facebook.avif" alt="facebook-logo">
            <img src="/asset/img/twitter.avif" alt="twitter-logo">
        </div>
    </div>
</footer>

</body>

</html>