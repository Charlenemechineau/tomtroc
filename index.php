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
        
        default:
            throw new Exception("L'action demandée n'est pas prise en charge.");
    }
} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
