<?php

/**
 * ErrorController
 * ---------------
 * Son rôle : afficher une page d’erreur 404 propre.
 * On l’appelle quand l’action n’existe pas ou qu’une ressource est introuvable.
 */
class ErrorController
{
    /**
     * Affiche la page 404.//
     * @param string $message  Texte affiché sous le titre (optionnel).//
     */
    public function notFound(string $message = "Oups ! La page que vous cherchez n'existe pas."): void
    {
        // 1) On envoie le bon code HTTP au navigateur : 404 = "Not Found"//
        //    (Important de le faire AVANT d’afficher quoi que ce soit)//
        http_response_code(404);

        // 2) On prépare l’affichage : on crée une vue avec le titre "Erreur"//
        $view = new View('Erreur');

        // 3) On rend la page 'errorPage.php' en lui passant des variables//
        //    - errorCode    : 404 (affiché dans la vue)//
        //    - errorMessage : le message personnalisé (ou celui par défaut)//
        $view->render('errorPage', [
            'errorCode'    => 404,
            'errorMessage' => $message,
        ]);

        // 4) / l’exécution s'arrète ici //
        exit;
    }
}