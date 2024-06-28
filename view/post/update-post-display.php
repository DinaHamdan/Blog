<main>
    <form id="update-post" action="/ctrl/post/update-post.php" method="post" enctype="multipart/form-data">

        <!-- Update blog-->
        <label for="post-title">Article title</label>
        <input type="text" id="post-title" name="post-title">

        <label for="create-post">Update Article here</label>
        <textarea id="update-text-area" name="create-post" id="createPost"></textarea>

        <!-- Update blog photo -->

        <div id="update-blog-photo-container">
            <label for="blogPhoto"> Update blog Image</label>
            <input type="file" id="blogPhoto" name="blogPhoto">
        </div>


        <div class="center-button">
            <button class="submit" type="submit">Submit</button>

        </div>

    </form>
</main>