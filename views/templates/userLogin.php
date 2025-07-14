<!--template Connexion -->
<section id="connexion-section">
    <div class="connexion-formulaire">

        <h1 id="connexion-title">Connexion</h1>

        <?php if (!empty($errorMessage)): ?>
            <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>

        <form method="post" action="index.php?action=loginUser">
            <label for="email">Adresse e-mail</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" class="bouton">Se connecter</button>
        </form>

        <p>Pas de compte ? <a href="#">Créer un compte</a></p>

    </div>

    <img src="images/Mask_group.png" alt="Photo de plusieurs livres" class="img-connexion">
</section>
