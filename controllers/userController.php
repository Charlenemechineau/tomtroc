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

    // Permet la déconnexion de l'utilisateur de sa session //
    public function logoutUser()
    {
        // Détruire la session
        session_destroy();
        
        // Rediriger vers l'accueil
        Utils::redirect("home");
    }


    // Affiche la page "Mon compte"
    public function showMyAccount()
    {
    // On vérifie si l'utilisateur est bien connecté (si on a une session 'user')
    if (!isset($_SESSION['user'])) {
        // S'il n'est pas connecté, on le redirige vers la page de connexion
        Utils::redirect("loginUser");
        return; // On arrête la fonction ici
    }
    
    // On récupère les informations de l'utilisateur connecté
    $user = $_SESSION['user'];
    
    // On crée un objet BookManager pour gérer les livres
    $bookManager = new BookManager();
    
    // On récupère la liste des livres appartenant à cet utilisateur grâce à son ID
    $userBooks = $bookManager->getBooksByUserId($user->getId());
    
    // On prépare la vue "Mon compte" pour afficher les infos utilisateur et ses livres
    $view = new View("Mon compte");
    $view->render("myAccount", [
        'user' => $user,         // On passe les infos utilisateur à la vue
        'books' => $userBooks    // On passe la liste des livres à la vue
    ]);
}


    // Met à jour les infos de l'utilisateur connecté
    public function updateAccount()
    {
        // On vérifie que le formulaire a été envoyé en POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On récupère l'utilisateur actuel dans la session
            $user = $_SESSION['user'];

            // On récupère l'id de l'utilisateur
            $id = $user->getId();
            
            // On récupère les données envoyées dans le formulaire (avec protection contre le code HTML)
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            
            // On récupère le mot de passe seulement s'il a été rempli, sinon null
            $password = !empty($_POST['password']) ? $_POST['password'] : null;

            // On crée un objet UserManager pour faire la mise à jour en base de données
            $userManager = new UserManager();

            // On appelle la méthode updateUser pour modifier les infos en base
            $updated = $userManager->updateUser($id, $pseudo, $email, $password);

            if ($updated) {
                // Si la mise à jour a réussi, on met à jour aussi l'objet utilisateur en session
                $user->setPseudo($pseudo);
                $user->setEmail($email);
                $_SESSION['user'] = $user;

                // On redirige vers la page mon-compte avec un message de succès
                header('Location: index.php?page=mon-compte&success=1');
                exit; // On arrête le script après la redirection
            } else {
                // En cas d'erreur, on redirige aussi vers mon-compte mais avec un message d'erreur
                header('Location: index.php?page=mon-compte&error=1');
                exit;
            }
        }
    }

    public function updateProfilePicture(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['profile_picture']['tmp_name'])) {
            $user = $_SESSION['user'];
            $userId = $user->getId();

            $file = $_FILES['profile_picture'];
            $fileName = uniqid() . "_" . basename($file['name']);
            $targetDir = "./css/user_pic/";
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                $this->userManager->updateProfilePicture($userId, $fileName);
                $user->setPictureUser($fileName);
                $_SESSION['user'] = $user;
            }

            Utils::redirect('myAccount');
        } else {
            Utils::redirect('myAccount');
        }
    }
}