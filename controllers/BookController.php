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

    //Function qui va me permettre de récupérer 
    public function showBookDetails()
    {
        // Récupère l'id du livre depuis l'URL (ex: index.php?action=bookDetails&id=3)
        $bookId = $_GET['id'] ?? null;

        if (!$bookId) {
            throw new Exception("L'identifiant du livre est manquant.");
        }

        // Récupère le livre correspondant via BookManager
        $bookManager = new BookManager();
        $book = $bookManager->getBookById((int)$bookId);

        if (!$book) {
            throw new Exception("Livre introuvable.");
        }

        // Récupère l'utilisateur propriétaire via UserManager
        $userManager = new UserManager();
        $user = $userManager->getUserById($book->getUserId());

        // Prépare et affiche la vue en passant les données du livre et du propriétaire
        $view = new View("Détail du livre");
        $view->render("detailbook", [
            "book" => $book,
            "user" => $user
        ]);
    }
}