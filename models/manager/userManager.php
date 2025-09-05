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
 * @param string $pseudo Le nom d'utilisateur choisi.
 * @param string $email L'adresse email de l'utilisateur.
 * @param string $password Le mot de passe en clair (non sécurisé).
 * @return bool Renvoie true si l'utilisateur est bien créé, sinon false.
 */
    public function createUser(string $pseudo, string $email, string $password): bool
        {
            // On transforme le mot de passe en une chaîne sécurisée grâce à la fonction hash (ici SHA512)
            $hashedPassword = hash("sha512", $password);
            
            // On prépare une requête pour ajouter un nouvel utilisateur dans la base de données
            $sql = "INSERT INTO users (pseudo, email, password, created_at) 
                    VALUES (:pseudo, :email, :password, NOW())";
            
            // On prépare cette requête pour l'exécuter en toute sécurité (éviter les attaques)
            $stmt = $this->db->prepare($sql);
            
            // On remplace les mots-clés de la requête par les vraies valeurs que l'on a reçues
            $stmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
            
            // On exécute la requête, et on retourne le résultat (true si ça marche, false sinon)
            return $stmt->execute();
        }



    /**
     * Mise à jour des données utilisateur.
     *
     * @param int $id L'identifiant de l'utilisateur à modifier.
     * @param string $pseudo Le nouveau nom d'utilisateur.
     * @param string $email La nouvelle adresse email.
     * @param string|null $password Le nouveau mot de passe (optionnel).
     * @return bool Renvoie true si la mise à jour a réussi, sinon false.
     */
    public function updateUser($id, $pseudo, $email, $password = null)
    {
        // On prépare la requête pour changer le pseudo et l'email
        $sql = "UPDATE users SET pseudo = :pseudo, email = :email";

        // Si on veut aussi changer le mot de passe (qu'il y en a un)
        if (!empty($password)) {
            // On ajoute la modification du mot de passe dans la requête
            $sql .= ", password = :password";
        }

        // On précise quel utilisateur on veut modifier grâce à son ID
        $sql .= " WHERE id = :id";

        // On prépare la requête pour l'exécuter
        $stmt = $this->db->prepare($sql);
        
        // On remplace les mots-clés dans la requête par les vraies valeurs
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':email', $email);

        // Si on change le mot de passe, on le sécurise avant de le mettre dans la requête
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindValue(':password', $hashedPassword);
        }

        // On ajoute l'id de l'utilisateur qu'on veut modifier
        $stmt->bindValue(':id', $id);

        // On exécute la requête et on renvoie si ça a fonctionné ou pas
        return $stmt->execute();
    }


/**
 * Met à jour la photo de profil d'un utilisateur.
 *
 * @param int $userId L'identifiant de l'utilisateur dont on veut changer la photo.
 * @param string $photoUtilisateur Le nom/fichier de la nouvelle photo de profil.
 * @return bool Renvoie true si la mise à jour a réussi, sinon false.
 */
public function updateProfilePicture(int $userId, string $photoUtilisateur): bool
{
    $sql = "UPDATE users SET picture_user = :picture_user WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':picture_user', $photoUtilisateur, PDO::PARAM_STR);
    $stmt->bindValue(':id', $userId, PDO::PARAM_INT);

    return $stmt->execute();
}
}