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
        $sql = "SELECT * FROM book";

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
}
