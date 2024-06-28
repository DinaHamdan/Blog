<main>

    <div id="all-posts-container">

        <?php foreach ($args['session']['listPost'] as $args['session']['post']) { ?>
            <!-- <div> -->
            <div id="post-container">
                <div id="text-blog">
                    <h2 id="blog-title"><?= $args['session']['post']['title'] ?></h2>
                    <p><?= $args['session']['post']['textContent'] ?></p>
                    <div id="blog-info">
                        <p>Published : <?= $args['session']['post']['time'] ?></p>
                        <p>Likes : <?= $args['session']['post']['nbLikes'] ?> </p>
                    </div>
                </div>
                <img id="blog-image" src="data:image/png;base64,<?= base64_encode($args['session']['post']['illustration']) ?>" alt="blog-photo">

            </div>
            <?php if ($args['session']['user']['codeRole'] == 'ADM') { ?>
                <div id="modify-article-container">
                    <a href="/ctrl/post/remove-post.php?id=<?= $args['session']['post']['id'] ?>" onclick="return confirm('are you sure you want to remove?');">Remove Post</a>
                    <a href="/ctrl/post/update-post-display.php?id=<?= $args['session']['post']['id'] ?>">Update Post</a>
                </div>

            <?php  } ?>




            <div id="comment-parent-container">
                <h2>Comments</h2>
                <?php foreach ($args['session']['post']['comments'] as $args['session']['post']['comment']) { ?>

                    <div id="comment-container">
                        <div id="user-container">
                            <img id="user-avatar" src="data:image/png;base64,<?= base64_encode($args['session']['post']['comment']['userAvatar']['avatar']) ?>" alt="user-Avatar">
                            <div id="comment-content">
                                <p><?= $args['session']['post']['comment']['phrase'] ?></p>
                                <p class="time">time : <?= $args['session']['post']['comment']['time'] ?></p>
                            </div>
                        </div>

                        <!-- If user is admin -->

                        <?php if ($args['session']['user']['codeRole'] == 'ADM') { ?>
                            <div id="remove-comment-container">
                                <a href="/ctrl/post/remove-comment.php?id=<?= $args['session']['post']['comment']['id'] ?>" onclick="return confirm('are you sure you want to remove?');">Remove Comment</a>
                            </div>
                        <?php  } ?>
                    </div>

                <?php } ?>




                <!-- If user is public -->
                <?php if (($args)['session']['user']['codeRole'] == 'PUB') { ?>
                    <div id="leave-comment-container">
                        <!-- Form to submit comment -->
                        <form action="/ctrl/post/comment-like-post.php" method="post">

                            <input name="hiddenId" type="hidden" value="<?= $args['session']['post']['id'] ?>" />
                            <a href="/ctrl/post/like-post.php?id=<?= $args['session']['post']['id'] ?>"><img id="like-logo" src="/asset/img/star.png" alt="star-like-button"></a>

                            <label for="comment">Leave a comment</label>
                            <input type="text" name="comment" id="comment">
                            <button class="submit" type="submit">Submit</button>

                        </form>



                    </div>
                <?php } ?>

            </div>
        <?php } ?>

    </div>

</main>