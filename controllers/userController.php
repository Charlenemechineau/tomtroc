<?php

class UserController
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        $view = new View("Connexion");
        $view->render("userlogin"); // login.php = ton template HTML que tu as déjà
    }

    // Traitement du formulaire de connexion
    public function loginUser()
    {
        $email = Utils::request("email");
        $password = Utils::request("password");

        $userManager = new UserManager();
        $user = $userManager->getUserByEmailandpassword($email);

        if ($user && password_verify($password, $user->getPassword())) {
            // Connexion réussie : on stocke l'utilisateur en session
            $_SESSION['user'] = $user;

            // Redirection vers l’accueil ou la page "Mon compte"
            Utils::redirect("home");
        } else {
            // Connexion échouée, on renvoie la vue avec un message
            $view = new View("Connexion");
            $view->render("userlogin", [
                'errorMessage' => "Email ou mot de passe incorrect."
            ]);
        }
    }
}