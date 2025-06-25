<?php 

class BookController
{
    // Cette méthode est appelée pour afficher la page d'accueil//
    public function showHome() : void
    {
        // crée une instance du BookManager pour interagir avec la base de données//
        $bookManager = new BookManager();

        // récupère tous les livres depuis la BDD (grâce à la méthode getAllBooks)//
        $books = $bookManager->getLastBooks();

        // crée une vue avec comme titre "Accueil"//
        $view = new View("Accueil");

        // affiche la vue "home" en lui passant les données des livres//
        $view->render("home", [
            'books' => $books
        ]);
    }


    public function showAllBooks() : void
    {
        // On instancie BookManager
        $bookManager = new BookManager();

        // On récupère TOUS les livres
        $books = $bookManager->getAllBooks();

        // On crée la vue pour la page "Tous les livres"
        $view = new View("Tous les livres");

        // On affiche la vue "books" avec toutes les données
        $view->render("books", [
            'books' => $books
        ]);
    }
}