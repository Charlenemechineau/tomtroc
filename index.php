<?php

require_once 'config/config.php';
require_once 'config/autoload.php';


$action = Utils::request('action', 'home');

try {
    switch ($action) {
        case 'home':
            $bookController = new BookController();
            $bookController->showHome();
            break;

        case 'books':
            $bookController= new BookController();
            $bookController->showAllBooks();
            break;

        case 'detailBook':
        $bookController = new BookController();
        $bookController->showBookDetails();
        break;
        
        case 'rechercheLivres':
        $bookController = new BookController();
        $bookController->rechercherLivres();
        break;
        
        case 'loginUser':
        $userController = new UserController();
        $userController->showLoginForm(); 
        break;

        case 'processLogin':
        $userController = new UserController();
        $userController->loginUser();
        break;

        case 'register':
        $userController = new UserController();
        $userController->showRegisterForm();
        break;

        case 'processRegister':
        $userController = new UserController();
        $userController->registerUser();
        break;

        case 'logout':
        $userController = new UserController();
        $userController->logoutUser();
        break;

        case 'myAccount':
        $userController = new UserController();
        $userController->showMyAccount();
        break;

        case 'updateAccount':
        $userController = new UserController();   
        $userController->updateAccount();
        break;

        default:
            throw new Exception("L'action demandée n'est pas prise en charge.");
    }
} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
