
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/database.php';

/** 
 * @param string email email of user
 * @param string password hashed
 * @param string passClear password in clear
 * @param string idRole the id of the user's role
 * @param binary binaryFile the avatar of the user in binary
 * @param string nameFile the pathway to the avatar in the directory
 * @param string username the name of the user
 * @return boolean sucess or failure
 * @return array array of object
 * */
class LibPost
{
    //Create a post
    static function createPost(string $blogTitle, string $blogContent, string $UserId,  $binaryFile, $nameFile, $dateTime): bool
    {
        $query = 'INSERT INTO article ( title, textContent, idUtilisateur, illustration, illustration_filename, date_time_column) VALUES ( :title, :textContent, :idUtilisateur, :illustration, :illustration_filename, :date_time_column)';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':title', $blogTitle);
        $statement->bindParam(':textContent', $blogContent);
        $statement->bindParam(':idUtilisateur', $UserId);
        $statement->bindParam(':illustration', $binaryFile, PDO::PARAM_LOB);
        $statement->bindParam(':illustration_filename', $nameFile, PDO::PARAM_STR);
        $statement->bindParam(':date_time_column', $dateTime);

        // - Exécute la requête
        $isSuccess = $statement->execute();
        return $isSuccess;
    }
    //List all posts
    static function getAllPost(): array
    {
        $query = 'SELECT article.id, article.title, article.textContent, article.illustration, article.date_time_column';
        $query .= ' FROM article ';
        $statement = libDb::connect()->prepare($query);
        $successOrFailure = $statement->execute();
        $listPost = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Ajoute une colonne avec la date de l'article formatée,
        // et charge les commentaires de chaque article
        $listPostWithAdditionalInfo = [];
        foreach ($listPost as $post) {

            $post['time'] = date('Y-m-d h:i:s', strtotime($post['date_time_column']));
            $post['comments'] = LibPost::listComment($post['id']);
            $post['likes'] = (LibPost::listLike($post['id']));
            $post['nbLikes'] = count(LibPost::listLike($post['id']));
            $listPostWithAdditionalInfo[] = $post;
        }

        return $listPostWithAdditionalInfo;
    }
    //Delete comments
    static function deleteComments(string $idArticle): bool
    {
        $query = 'DELETE FROM commentaire WHERE commentaire.idArticle= :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idArticle);
        $isSuccess = $statement->execute();
        return $isSuccess;
    }
    static function deleteLikes(string $idArticle): bool
    {
        $query = 'DELETE FROM putLike WHERE putLike.idArticle= :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idArticle);
        $isSuccess = $statement->execute();
        return $isSuccess;
    }
    //Delete Likes of user before deleting user
    static function deleteLikesUser(string $idUser): bool
    {
        $query = 'DELETE FROM putLike WHERE putLike.idUtilisateur= :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idUser);
        $isSuccess = $statement->execute();
        return $isSuccess;
    }

    //Delete Post
    static function deleteArticle(string $idArticle): bool
    {
        $query = 'DELETE FROM article WHERE  id= :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idArticle);
        $isSuccess = $statement->execute();
        return $isSuccess;
    }

    //Delete comments
    static function deleteComment(string $idComment): bool
    {
        $query = 'DELETE FROM commentaire WHERE id= :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idComment);
        $isSuccess = $statement->execute();
        return $isSuccess;
    }


    //update article
    static function updateArticle(string $idArticle, string $blogTitle, string $blogContent, string $UserId,  $binaryFile, $nameFile, $dateTime): bool
    {
        $query = 'UPDATE article SET title = :title , textContent= :textContent, idUtilisateur= :idUtilisateur, illustration = :illustration, illustration_filename =:illustration_filename, date_time_column= :date_time_column WHERE id =:id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idArticle);
        $statement->bindParam(':title', $blogTitle);
        $statement->bindParam(':textContent', $blogContent);
        $statement->bindParam(':idUtilisateur', $UserId);
        $statement->bindParam(':illustration', $binaryFile, PDO::PARAM_LOB);
        $statement->bindParam(':illustration_filename', $nameFile, PDO::PARAM_STR);
        $statement->bindParam(':date_time_column', $dateTime);

        // - Exécute la requête
        $isSuccess = $statement->execute();
        return $isSuccess;
    }

    //List post for update option
    static function getPost($idArticle): array
    {
        $query = 'SELECT article.id, article.textContent, article.illustration, article.date_time_column';
        $query .= ' FROM article ';
        $query .= 'WHERE article.id = :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idArticle);
        // - Exécute la requête
        $successOrFailure = $statement->execute();
        $post = $statement->fetch(PDO::FETCH_ASSOC);

        return $post;
    }

    //Create a comment
    static function createComment(string $commentContent, string $userId,  string $idArticle, $dateTime): bool
    {
        $query = 'INSERT INTO commentaire( phrase, idUtilisateur, idArticle, date_time_column) VALUES ( :phrase, :idUtilisateur, :idArticle, :date_time_column)';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':phrase', $commentContent);
        $statement->bindParam(':idUtilisateur', $userId);
        $statement->bindParam(':idArticle', $idArticle);
        $statement->bindParam(':date_time_column', $dateTime);

        // - Exécute la requête
        $isSuccess = $statement->execute();
        return $isSuccess;
    }

    //List comment added to get all posts function
    static function listComment(string $idArticle): array
    {
        $query = 'SELECT commentaire.id, commentaire.phrase, commentaire.idArticle, commentaire.idUtilisateur, commentaire.date_time_column';
        $query .= ' FROM commentaire ';
        $query .= 'WHERE commentaire.idArticle = :id';

        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idArticle);
        // - Exécute la requête
        $successOrFailure = $statement->execute();
        $listComment = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Add a column with formatted data
        $listCommentWithAdditionalInfo = [];
        foreach ($listComment as $comment) {
            $comment['time'] = date('Y-m-d h:i:s', strtotime($comment['date_time_column']));

            //Add user avatar for each comment
            $comment['userAvatar'] = LibPost::getAvatar($comment['idUtilisateur']);
            $listCommentWithAdditionalInfo[] = $comment;
        }

        return $listCommentWithAdditionalInfo;
    }

    //Like a post
    static function like(string $idUser, string $idArticle, $dateTime): bool
    {
        $query = 'INSERT INTO putLike( idUtilisateur, idArticle, date_time_column) VALUES ( :idUtilisateur, :idArticle, :date_time_column)';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':idUtilisateur', $idUser);
        $statement->bindParam(':idArticle', $idArticle);
        $statement->bindParam(':date_time_column', $dateTime);
        // - Exécute la requête
        $isSuccess = $statement->execute();
        return $isSuccess;
    }
    //List all likes, check if a certain post is liked by a user
    static function hasAlreadyLiked($idUser, $idArticle): bool
    {
        $query = 'SELECT putLike.id, putLike.idArticle, putLike.idUtilisateur, putLike.date_time_column';
        $query .= ' FROM putLike';
        $query .= ' WHERE putLike.idArticle = :id';
        $query .= ' AND putLike.idUtilisateur = :idUser';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idArticle);
        $statement->bindParam(':idUser', $idUser);

        $successOrFailure = $statement->execute();
        $likes = $statement->fetchAll(PDO::FETCH_ASSOC);

        return !empty($likes);
    }

    //List Likes added to get all posts function
    static function listLike(string $idArticle): ?array
    {
        $query = 'SELECT  putLike.id, putLike.idArticle, putLike.idUtilisateur, putLike.date_time_column';
        $query .= ' FROM putLike';
        $query .= ' WHERE putLike.idArticle= :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idArticle);

        // - Exécute la requête
        $successOrFailure = $statement->execute();
        $listLike = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $listLike;
    }
    //Getting user avar function used with getting comment function
    static function getAvatar(string $userId): array
    {
        $query = 'SELECT  utilisateur.avatar';
        $query .= ' FROM utilisateur';
        $query .= ' WHERE utilisateur.id= :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $userId);

        // - Exécute la requête
        $successOrFailure = $statement->execute();
        $userAvatar = $statement->fetch(PDO::FETCH_ASSOC);
        return $userAvatar;
    }
}
