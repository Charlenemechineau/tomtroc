<?php

require_once 'config/config.php';
require_once 'config/autoload.php';


$action = Utils::request('action', 'home');

try {
    switch ($action) {
         case 'home':
        // Accueil : affiche les derniers livres
        $bookController = new BookController();
        $bookController->showHome();
        break;

        case 'books':
            // Page "Nos livres à l'échange" : liste tous les livres//
            $bookController = new BookController();
            $bookController->showAllBooks();
            break;

        case 'detailBook':
            // Détail d’un livre affiche la fiche du livre + propriétaire //
            $bookController = new BookController();
            $bookController->showBookDetails();
            break;

        case 'rechercheLivres':
            // Recherche : filtre les livres par titre //
            $bookController = new BookController();
            $bookController->rechercherLivres();
            break;


        case 'loginUser':
            // Affiche le formulaire de connexion//
            $userController = new UserController();
            $userController->showLoginForm();
            break;

        case 'processLogin':
            // Traite la connexion d'un compte utilisateur//
            $userController = new UserController();
            $userController->loginUser();
            break;

        case 'register':
            // Affiche le formulaire d'inscription//
            $userController = new UserController();
            $userController->showRegisterForm();
            break;

        case 'processRegister':
            // Traite l'inscription //
            $userController = new UserController();
            $userController->registerUser();
            break;

        case 'logout':
            // Déconnecte l'utilisateur puis redirige//
            $userController = new UserController();
            $userController->logoutUser();
            break;

        case 'myAccount':
            // Page "Mon compte" : liste les livres de l'utilisateur connecté//
            $userController = new UserController();
            $userController->showMyAccount();
            break;

        case 'updateAccount':
            // Met à jour les informations du compte utilisateur //
            $userController = new UserController();
            $userController->updateAccount();
            break;

        case 'updateProfilePicture':
            //Met à jour la photo de profil de l'utilisateur//
            $userController = new UserController();
            $userController->updateProfilePicture();
            break;

        case 'messagerie':
            // Affiche la messagerie : liste de conversations + fil.
            // Option GET 'user' pour ouvrir directement une conversation avec cet utilisateur.//
            $messageController = new MessageController();
            $messageController->showMessages();
            break;

        case 'sendMessage':
            // Envoie un message puis redirige vers la messagerie//
            $messagerieController = new MessageController();
            $messagerieController->sendMessage();
            break;


        case 'editBook':
            // Affiche le formulaire d’édition d’un livre //
            $bookController = new BookController();
            $bookController->showEditBook();
            break;

        case 'updateBookDetails':
            // Met à jour les champs texte d’un livre (POST: book_id, title, author, description, disponibilite)//
            // Redirige ensuite (ex: vers myAccount)//
            $bookController = new BookController();
            $bookController->updateBookDetails();
            break;

        case 'updateBookImage':
            // Met à jour uniquement la photo de couverture//
            // Redirige ensuite//
            $bookController = new BookController();
            $bookController->updateBookImage();
            break;

        case 'deleteBook':
            // Permet la suppression un livre //
            $bookController = new BookController();
            $bookController->deleteBook();
            break;
        
        case 'userProfile':
            // Profil public : affiche les infos d’un utilisateur + ses livres //
            $userController = new UserController();
            $userController->showPublicProfile();
            break;

        default:
            // affichage de ma route si erreur page 404 //
            (new ErrorController())->notFound("Cette page n'existe pas.");
            break;
        }

} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
