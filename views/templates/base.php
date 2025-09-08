<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=League+Spartan:wght@500;600;700&family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/beda2b5283.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="headerConteneur">
                <div class="Logo">
                    <a href="index.php?action=home"><img src="./images/logo.png"  alt=""></a>
                </div>
            <div class="nav-sections">    
                <nav class="main-nav">
                    <ul class="main-menu">
                        <a href="index.php?action=home"><li>Accueil</li></a> <!--Lien vers la page d'acceuil-->
                        <a href="index.php?action=books"><li>Nos livres à l'échange</li></a> <!-- lien vers la page nos livre à l'échange-->
                </nav>
                <nav class="utilisateur-nav">
                    <ul>
                        <li><a href="index.php?action=messagerie" class="message-link"><i class="fa-regular fa-message"></i> Messagerie
                            <?php if (isset($_SESSION['user']) && isset($unreadMessagesCount) && $unreadMessagesCount > 0): ?>
                                <span class="notification-badge"><?= $unreadMessagesCount ?></span>
                            <?php endif; ?></a>
                        </li> 

                        <li><a href="index.php?action=myAccount"><i class="fa-regular fa-user"></i> Mon compte</a></li>   
                        
                        <?php if (!isset($_SESSION['user'])): ?>
                            <li><a href="index.php?action=loginUser">Connexion</a></li> <!-- lien pour la connexion au compte Utilisateur-->
                        <?php else: ?>
                            <li><a href="index.php?action=logout">Déconnexion</a></li> <!--Lien pour la déconnexion du compte -->
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>    
    </header>

    <main>  
        <?= $content ?>
    </main>
    
    <footer>
        <div class="footer">
            <ul>
                <li>Politique de confidentialité</li>
                <li>Mentions légales</li>
                <li>Tom Troc©</li>
                <li><img src=" ./images/footer-logo.png" alt="logo du footer"></li>
            </ul>
        </div>
    </footer>
</body>
</html>