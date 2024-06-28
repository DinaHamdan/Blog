<main>
    <form id="write-post" action="/ctrl/post/create-post.php" method="post" enctype="multipart/form-data">

        <!-- Write blog-->
        <label for="post-title">Article title</label>
        <input type="text" id="post-title" name="post-title">

        <label for="create-post">Write Article here</label>
        <textarea id="blog-text-area" name="create-post" id="createPost"></textarea>


        <!-- Blog photo -->

        <div id="blog-photo-container">
            <label for="blogPhoto">Blog Image</label>
            <input type="file" id="blogPhoto" name="blogPhoto">
        </div>

        <div class="center-button">
            <button class="submit" type="submit">Submit</button>

        </div>


    </form>
</main>