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

    //Function qui va me permettre de récupérer les éléments du detail d'un livre//
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
    // On crée une instance de BookManager pour accéder aux méthodes de gestion des livres/
    $bookManager = new BookManager();

    // On récupère le mot-clé saisi par l'utilisateur dans le champ "recherche" (ou une chaîne vide par défaut)//
    $recherche = Utils::request('recherche', '');

    // On exécute la recherche en BDD avec le mot-clé//
    $books = $bookManager->findBooksByTitle($recherche);

    // Si on a trouvé exactement 1 livre...//
    if (count($books) === 1) {
        // On récupère ce livre//
        $book = $books[0];

        // On crée une instance de UserManager pour aller chercher l'utilisateur qui a publié ce livre//
        $userManager = new UserManager();

        // On récupère l'utilisateur propriétaire du livre via son ID (stocké dans l'objet $book)//
        $user = $userManager->getUserById($book->getUserId());

        // On prépare la vue "detailbook" pour afficher la fiche du livre//
        $view = new View("Détail du livre");

        // On affiche la vue en lui passant les données du livre et de son utilisateur//
        $view->render("detailbook", [
            "book" => $book,
            "user" => $user
        ]);
    } else {
        // Sinon (zéro ou plusieurs livres trouvés),//
        // on affiche simplement la vue "books" avec les résultats//

        $view = new View("Résultat de recherche");

        // On envoie tous les livres trouvés à la vue
        $view->render("books", [
            "books" => $books
        ]);
    }
}


//************************************* partie template editBook ***********************/

// Méthode qui affiche le formulaire de modification //
public function showEditBook() : void
{
    // Récupérer l'id depuis l'URL
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) { Utils::redirect('myAccount'); return; }

    // Charger le livre
    $bookManager = new BookManager();
    $book = $bookManager->getBookById($id);
    if (!$book) { Utils::redirect('myAccount'); return; }

    // Afficher la vue d’édition
    $view = new View("Modifier un livre");
    // Fichier attendu : views/editbook.php //
    $view->render("editbook", ['book' => $book]);
}

//Méthode qui va traiter la mise à jour des champs texte (title/author/description/disponibilite) d'un livre//
// Met à jour les infos texte d’un livre (titre, auteur, description, disponibilité)
public function updateBookDetails() : void
{
    // Ne traite cette action que si le formulaire a bien été envoyé en POST//
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
        Utils::redirect('myAccount'); 
        return; 
    }

    // Orécupère l’ID du livre envoyé par le champ caché du formulaire//
    $id = (int)($_POST['book_id'] ?? 0);

    // lit les champs du formulaire ( "trim" permet d'enlever les espaces inutiles)//
    $title        = trim($_POST['title'] ?? '');
    $author       = trim($_POST['author'] ?? '');
    $description  = trim($_POST['description'] ?? '');
    $disponibilite= trim($_POST['disponibilite'] ?? 'Disponible');

    // appelle le modèle pour enregistrer en base de données//
    $bookManager = new BookManager();
    $bookManager->updateBookDetails($id, $title, $author, $description, $disponibilite);

    // valider pour retourner sur la page "Mon compte"//
    Utils::redirect('myAccount');
}


// Change uniquement la photo de couverture d’un livre//
public function updateBookImage(): void
{
    // Action autorisée seulement si le formulaire a été envoyé en POST//
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
        Utils::redirect('myAccount'); 
        return; 
    }

    // Récupère l’ID du livre et le fichier envoyé//
    $bookId = (int)($_POST['book_id'] ?? 0);
    $file   = $_FILES['book_picture'] ?? null;

    // Dossier où sont stockées les images //
    $targetDir = 'images/';

    // On vérifie qu’on a bien un livre + un fichier valide
    if ($bookId && $file && $file['error'] === UPLOAD_ERR_OK) {

        //  On fabrique un nom de fichier unique pour éviter d’écraser une ancienne image//
        $fileName = uniqid('book_'.$bookId.'_') . '_' . basename($file['name']);

        // On déplace le fichier uploadé dans le dossier cible//
        if (move_uploaded_file($file['tmp_name'], $targetDir . $fileName)) {

            // Si tout va bien, on enregistre SEULEMENT le nom du fichier en base//
            (new BookManager())->updateBookImage($bookId, $fileName);
        }
    }

    // On  reste sur editBook pour verifier que la bonne photo est bien changé)
     Utils::redirect('editBook', ['id' => $bookId]);
}
}