<main>

    <form id="inscription-form" action="/ctrl/inscription/create.php" method="post" enctype="multipart/form-data">

        <!-- Identifiant -->
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </div>


        <!-- Mots de passe -->
        <div>
            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass">
        </div>
        <div>
            <label for="description">Write a sentence about yourself </label>
            <textarea type="description" id="description" name="description"></textarea>
        </div>
        <div>
            <label for="file">Your profile photo</label>
            <input type="file" id="file" name="file">
        </div>


        <button class="submit" type="submit">Validate</button>
        <a href="/ctrl/inscription/create-admin-display.php">Register as Admin?</a>
    </form>


</main>