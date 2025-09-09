<!--template Connexion -->
<section id="connexion-section">
    <div class="connexion-formulaire">

        <h1 id="connexion-title">Connexion</h1>
        
        <!-- Vérifie si un message d'erreur existe, et l'affiche de façon sécurisée pour informer l'utilisateur -->
        <?php if (!empty($errorMessage)): ?>
            <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>

        <form method="post" action="index.php?action=processLogin">
            <label for="email">Adresse e-mail</label>
            <input class="force-blanc" type="email" name="email" id="email" required> <!--Permet de rendre obligatoire le champs e-mail-->
            

            <label for="password">Mot de passe</label>
            <input class="force-blanc" type="password" name="password" id="password" required> <!--Permet de rendre obligatoire le champ mot de passe-->

            <button type="submit" class="bouton">Se connecter</button>
        </form>

        <p>Pas de compte ? <a href="index.php?action=register">Inscrivez-vous</a></p> <!-- Lien qui me redirige vers la mire d'inscritption -->

    </div>

    <img src="images/Mask_group.png" alt="Photo de plusieurs livres" class="img-connexion">
</section>
