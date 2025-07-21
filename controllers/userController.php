<?php

class UserController
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        $view = new View("Connexion");
        $view->render("userlogin"); 
    }

    // Traitement du formulaire de connexion
    public function loginUser()
    {
        $email = Utils::request("email");
        $password = Utils::request("password");

        $userManager = new UserManager();
        
        // Utilisation de la  méthode qui gère le hachage SHA512
        $user = $userManager->getUserByEmailAndPassword($email, $password);

        if ($user) {
            // Connexion réussie : on stocke l'utilisateur en session
            $_SESSION['user'] = $user;

            // Redirection vers l'accueil ou la page "Mon compte"
            Utils::redirect("home");
        } else {
            // Connexion échouée, on renvoie la vue avec un message
            $view = new View("Connexion");
            $view->render("userlogin", [
                'errorMessage' => "Email ou mot de passe incorrect."
            ]);
        }
    }

    // Affiche le formulaire d'inscription
    public function showRegisterForm()
    {
        $view = new View("Inscription");
        $view->render("register");
    }

    // Traitement du formulaire d'inscription
    public function registerUser()
    {
        $pseudo = Utils::request("pseudo");
        $email = Utils::request("email");
        $password = Utils::request("password");

        $userManager = new UserManager();
        
        // Vérifier si l'email existe déjà
        $existingUser = $userManager->getUserByEmail($email);
        if ($existingUser) {
            $view = new View("Inscription");
            $view->render("register", [
                'errorMessage' => "Cette adresse email est déjà utilisée."
            ]);
            return;
        }

        // Créer l'utilisateur (le mot de passe sera haché en SHA512)
        $success = $userManager->createUser($pseudo, $email, $password);
        
        if ($success) {
            // Inscription réussie, rediriger vers la connexion
            Utils::redirect("loginUser");
        } else {
            $view = new View("Inscription");
            $view->render("register", [
                'errorMessage' => "Erreur lors de l'inscription. Veuillez réessayer."
            ]);
        }
    }

    // Déconnexion
    public function logoutUser()
    {
        // Détruire la session
        session_destroy();
        
        // Rediriger vers l'accueil
        Utils::redirect("home");
    }
}