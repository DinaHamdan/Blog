

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
class LibUser
{
    // List User role
    static function getUserRole(): array
    {
        $query = 'SELECT role.id, role.label';
        $query .= ' FROM role';
        $statement = libDb::connect()->prepare($query);

        // - Exécute la requête
        $successOrFailure = $statement->execute();
        $userRole = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $userRole;
    }
    //Create a user
    static function createUser(string $email, string $description, string $password, string $passClear, string $idRole, $binaryFile, $nameFile): bool
    {
        $query = 'INSERT INTO utilisateur ( email, description, pass, passClear, idRole, avatar, avatar_filename) VALUES ( :email, :description, :pass, :passClear, :idRole, :avatar, :avatar_filename)';
        $statement = libDb::connect()->prepare($query);

        $statement->bindParam(':email', $email);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':pass', $password);
        $statement->bindParam(':passClear', $passClear);
        $statement->bindParam(':idRole', $idRole);
        $statement->bindParam(':avatar', $binaryFile, PDO::PARAM_LOB);
        $statement->bindParam(':avatar_filename', $nameFile, PDO::PARAM_STR);
        // - Exécute la requête
        $isSuccess = $statement->execute();
        return $isSuccess;
    }
    //List user with email only
    static function getUser(string $email): ?array
    {
        $query = 'SELECT utilisateur.id, utilisateur.email, utilisateur.pass, role.id AS idRole, role.code AS codeRole, role.label as roleLabel';
        $query .= ' FROM utilisateur ';
        $query .= ' JOIN role ON utilisateur.idRole = role.id';
        $query .= ' WHERE utilisateur.email= :email';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':email', $email);

        // - Exécute la requête
        $successOrFailure = $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        // var_dump($user);
        if ($user == false) {
            $user = null;
        };
        return $user;
    }

    //Delete comments
    static function deleteComment(string $idComment): bool
    {
        $query = 'DELETE FROM commentaire WHERE idUtilisateur= :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idComment);
        $isSuccess = $statement->execute();
        return $isSuccess;
    }
    //Delete User
    static function deleteUser(string $idUser): bool
    {
        $query = 'DELETE FROM utilisateur WHERE  id= :id';
        $statement = libDb::connect()->prepare($query);
        $statement->bindParam(':id', $idUser);
        $isSuccess = $statement->execute();
        return $isSuccess;
    }


    static function getAllUserProfile(): array
    {
        $query = 'SELECT utilisateur.id, utilisateur.description, utilisateur.email, utilisateur.avatar';
        $query .= ' FROM utilisateur ';
        $statement = libDb::connect()->prepare($query);
        $successOrFailure = $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $user;
    }

    // static function getUserProfile(string $userId): array
    // {
    //     $query = 'SELECT utilisateur.id, utilisateur.email, utilisateur.avatar';
    //     $query .= ' FROM utilisateur ';
    //     $query .= ' WHERE utilisateur.id= :id';
    //     $statement = libDb::connect()->prepare($query);
    //     $statement->bindParam(':id', $userId);

    //     // - Exécute la requête
    //     $successOrFailure = $statement->execute();
    //     $user = $statement->fetch(PDO::FETCH_ASSOC);

    //     return $user;
    // }
}
