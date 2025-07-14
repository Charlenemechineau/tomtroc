<?php

// Cette classe gère les opérations liées aux utilisateurs.
// Elle hérite de AbstractEntityManager qui fournit la connexion PDO ($db).
class UserManager extends AbstractEntityManager
{
    /**
     * Récupère un utilisateur à partir de son identifiant unique.
     *
     * @param int $id L'identifiant de l'utilisateur.
     * @return User|null Retourne un objet User si trouvé, sinon null.
     */
    public function getUserById(int $id): ?User
    {
        // Requête SQL pour sélectionner l'utilisateur par son ID
        $sql = "SELECT * FROM users WHERE id = :id";

        // Préparation de la requête
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des données
        $data = $stmt->fetch();

        // Si l'utilisateur existe, on retourne un objet User
        if ($data) {
            return new User($data);
        }

        return null;
    }

    /**
     * Récupère un utilisateur à partir de son email.
     *
     * @param string $email L'adresse email de l'utilisateur.
     * @return User|null Retourne un objet User si trouvé, sinon null.
     */
    public function getUserByEmailandpassword(string $email): ?User
    {
        // Requête SQL pour récupérer un utilisateur selon son email et son password 
        $password = hash("sha512", $password);
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password" ;

        // Préparation de la requête
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        // Exécution
        $stmt->execute();

        // Récupération
        $data = $stmt->fetch();

        // Conversion en objet User si des données existent
        if ($data) {
            return new User($data);
        }

        return null;
    }
}