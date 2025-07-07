<?php

// Cette classe permet de gérer les livres, notamment en récupérant les données depuis la base de données.
// Elle hérite d'AbstractEntityManager qui contient la connexion $db.
class BookManager extends AbstractEntityManager
{
    /**
     * Récupère tous les livres stockés dans la table `book`.
     * 
     * @return Book[] Un tableau d'objets Book représentant tous les livres.
     */
    public function getAllBooks() : array
    {
        // Requête SQL pour sélectionner toutes les colonnes de tous les livres.
        $sql = "SELECT book.*, users.pseudo, users.picture_user 
                FROM book 
                LEFT JOIN users ON book.user_id = users.id";


        // Exécution de la requête.
        $result = $this->db->query($sql);

        // Tableau qui contiendra tous les objets Book.
        $books = [];

        // Parcours des résultats ligne par ligne.
        while ($book = $result->fetch()) {
            // Création d'un objet Book à partir des données récupérées et ajout au tableau.
            $books[] = new Book($book);
        }

        // Retourne le tableau complet d'objets Book.
        return $books;
    }

    /**
     * Récupère les derniers livres ajoutés dans la table `book`.
     * 
     * @param int $limite Le nombre maximum de livres à récupérer (par défaut 4).
     * @return Book[] Un tableau d'objets Book représentant les derniers livres.
     */
    public function getLastBooks(int $limite = 4) : array
    {
        // Requête SQL pour récupérer un nombre limité de livres.
        $sql = "SELECT * FROM book LIMIT " . $limite;

        // Exécution de la requête.
        $result = $this->db->query($sql);

        // Tableau pour stocker les livres récupérés.
        $books = [];

        // Parcours des résultats.
        while ($book = $result->fetch()) {
            // Création d'un objet Book et ajout au tableau.
            $books[] = new Book($book);
        }

        // Retourne le tableau des derniers livres.
        return $books;
    }


/**
 * Récupère un livre spécifique dans la base de données grâce à son ID.
 * 
 * @param int $id L'identifiant unique du livre à récupérer.
 * @return Book|null Retourne un objet Book si trouvé, sinon null.
 */

    // Prépare la requête SQL avec un paramètre nommé :id pour sélectionner un livre par son identifiant
    public function getBookById(int $id): ?Book
{
    $sql = "SELECT * FROM book WHERE id = :id";

    // Préparer la requête (pour gérer le paramètre :id)
    $stmt = $this->db->prepare($sql);

    // Lier la valeur $id au paramètre :id
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer une seule ligne de résultat
    $data = $stmt->fetch();


    if ($data) {
        return new Book($data); 
    }

    return null;
}

}
