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

            // Redirection vers la page "Mon compte"
            Utils::redirect("myAccount");
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

    /**
 * Met à jour la photo de profil de l’utilisateur connecté.
 *
 * Étapes :
 * 1) Vérifier que l’utilisateur est connecté et que le formulaire a bien été envoyé en POST.
 * 2) Récupérer le fichier envoyé via l’input "profile_picture".
 * 3) Générer un nom de fichier unique et définir le dossier de destination.
 * 4) Déplacer le fichier sur le serveur puis enregistrer le nouveau nom en base.
 * 5) Mettre à jour la session et rediriger vers la page "Mon compte".
 */
public function updateProfilePicture(): void
{
    // 1) Sécurité : on s’assure que l’utilisateur est connecté et que la requête est bien un POST
    if (!isset($_SESSION['user'])) { Utils::redirect('loginUser'); return; }
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { Utils::redirect('myAccount'); return; }

    // 2) On vérifie qu’un fichier a bien été envoyé et sans erreur
    if (empty($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
        Utils::redirect('myAccount');
        return;
    }

    $user   = $_SESSION['user'];
    $userId = (int)$user->getId();
    $file   = $_FILES['profile_picture'];

    // 3) On fabrique un nom unique et on définit le dossier où enregistrer l’image
    $fileName   = uniqid('user_' . $userId . '_') . '_' . basename($file['name']);
    $targetDir  = 'images/pictures/';   // même dossier que celui utilisé dans l’attribut src de <img>
    $targetPath = $targetDir . $fileName;

    // 4) On déplace le fichier et, si tout va bien, on met à jour la BDD puis la session
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        (new UserManager())->updateProfilePicture($userId, $fileName);
        $user->setPictureUser($fileName);    // met à jour l’objet en session pour afficher la nouvelle photo immédiatement
        $_SESSION['user'] = $user;
    }

    // 5) On retourne sur la page “Mon compte”
    Utils::redirect('myAccount');
}


 //****************************Partie template profil utilisateurs******************/
 
 public function showPublicProfile(): void
{
    $userId = (int)($_GET['id'] ?? 0);
    if ($userId <= 0) { Utils::redirect('home'); return; }

    $userManager = new UserManager();
    $bookManager = new BookManager();

    $user  = $userManager->getUserById($userId);
    if (!$user) { Utils::redirect('home'); return; }

    $books = $bookManager->getBooksByUserId($userId);
    $bookCount = count($books);


    $membreDepuis = '';
    if (method_exists($user, 'getCreatedAt') && $user->getCreatedAt()) {
        try {
            $d1 = new DateTime($user->getCreatedAt());
            $diff = $d1->diff(new DateTime());
            if ($diff->y >= 1)   $membreDepuis = $diff->y.' an'.($diff->y>1?'s':'');
            elseif ($diff->m>=1) $membreDepuis = $diff->m.' mois';
            else                  $membreDepuis = $diff->d.' jour'.($diff->d>1?'s':'');
        } catch (Throwable $e) {}
    }

    $view = new View("Profil public");
    $view->render("publicProfil", [
        'user'         => $user,
        'books'        => $books,
        'bookCount'    => $bookCount,
        'membreDepuis' => $membreDepuis,
    ]);
}
}