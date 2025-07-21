<?php

// Cette classe gère toutes les actions liées à la base de données des utilisateurs.
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
     * Récupère un utilisateur à partir de son email SEULEMENT.
     *
     * @param string $email L'adresse email de l'utilisateur.
     * @return User|null Retourne un objet User si trouvé, sinon null.
     */
    public function getUserByEmail(string $email): ?User
    {
        // Requête SQL pour récupérer un utilisateur selon son email seulement
        $sql = "SELECT * FROM users WHERE email = :email";

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

    /**
     * Vérifie les identifiants de connexion (email + password).
     *
     * @param string $email L'adresse email de l'utilisateur.
     * @param string $password Le mot de passe en clair.
     * @return User|null Retourne un objet User si connexion réussie, sinon null.
     */
    public function getUserByEmailAndPassword(string $email, string $password): ?User
    {
        // Hachage du mot de passe avec SHA512
        $hashedPassword = hash("sha512", $password);
        
        // Requête SQL pour récupérer un utilisateur selon son email et son password 
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";

        // Préparation de la requête
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);

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

    /**
     * Crée un nouvel utilisateur (pour l'inscription).
     *
     * @param string $pseudo Le pseudonyme de l'utilisateur.
     * @param string $email L'adresse email de l'utilisateur.
     * @param string $password Le mot de passe en clair.
     * @return bool True si création réussie, false sinon.
     */
    public function createUser(string $pseudo, string $email, string $password): bool
    {
        // Hachage du mot de passe avec SHA512 //
        $hashedPassword = hash("sha512", $password);
        
        $sql = "INSERT INTO users (pseudo, email, password, created_at) 
                VALUES (:pseudo, :email, :password, NOW())";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        
        return $stmt->execute();
    }
}