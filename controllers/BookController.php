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
        // On instancie BookManager//
        $bookManager = new BookManager();

        // On récupère TOUS les livres//
        $books = $bookManager->getAllBooks();

        // On crée la vue pour la page "Tous les livres"//
        $view = new View("Tous les livres");

        // On affiche la vue "books" avec toutes les données//
        $view->render("books", [
            'books' => $books
        ]);
    }

    //Function qui va me permettre de récupérer//
    public function showBookDetails()
    {
        // Récupère l'id du livre depuis l'URL (ex: index.php?action=bookDetails&id=3)//
        $bookId = $_GET['id'] ?? null;

        if (!$bookId) {
            throw new Exception("L'identifiant du livre est manquant.");
        }

        // Récupère le livre correspondant via BookManager//
        $bookManager = new BookManager();
        $book = $bookManager->getBookById((int)$bookId);

        if (!$book) {
            throw new Exception("Livre introuvable.");
        }

        // Récupère l'utilisateur propriétaire via UserManager//
        $userManager = new UserManager();
        $user = $userManager->getUserById($book->getUserId());

        // Prépare et affiche la vue en passant les données du livre et du propriétaire//
        $view = new View("Détail du livre");
        $view->render("detailbook", [
            "book" => $book,
            "user" => $user
        ]);
    }


    public function rechercherLivres()
{
    // On crée une instance de BookManager pour accéder aux méthodes de gestion des livres
    $bookManager = new BookManager();

    // On récupère le mot-clé saisi par l'utilisateur dans le champ "recherche" (ou une chaîne vide par défaut)
    $recherche = Utils::request('recherche', '');

    // On exécute la recherche en BDD avec le mot-clé
    $books = $bookManager->findBooksByTitle($recherche);

    // Si on a trouvé exactement 1 livre...
    if (count($books) === 1) {
        // On récupère ce livre
        $book = $books[0];

        // On crée une instance de UserManager pour aller chercher l'utilisateur qui a publié ce livre
        $userManager = new UserManager();

        // On récupère l'utilisateur propriétaire du livre via son ID (stocké dans l'objet $book)
        $user = $userManager->getUserById($book->getUserId());

        // On prépare la vue "detailbook" pour afficher la fiche du livre
        $view = new View("Détail du livre");

        // On affiche la vue en lui passant les données du livre et de son utilisateur
        $view->render("detailbook", [
            "book" => $book,
            "user" => $user
        ]);
    } else {
        // Sinon (zéro ou plusieurs livres trouvés),
        // on affiche simplement la vue "books" avec les résultats

        $view = new View("Résultat de recherche");

        // On envoie tous les livres trouvés à la vue
        $view->render("books", [
            "books" => $books
        ]);
    }
}

}