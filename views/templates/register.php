<!-- TEMPLATE DE LA PAGE INSCRIPTION -->

<section id="inscription-section">
    <div class="formulaire-connexion inscription">

        <h1 id="titre-inscription">Inscription</h1>
 
        <!--  Formulaire d'inscription utilisateur.
        Les données (pseudo, email, mot de passe) sont envoyées vers index.php avec l'action "registerUser".
        La méthode POST est utilisée pour sécuriser l'envoi (les données ne sont pas visibles dans l'URL).-->
        <form action="index.php?action=processRegister" method="post">
            <label for="pseudo">Pseudo</label>
            <input class="force-blanc" type="text" name="pseudo" id="pseudo" required> <!--Permet de rendre obligatoire le champ pseudo-->
            
            <label for="email">Adresse e-mail</label>
            <input class="force-blanc" type="email" name="email" id="email" required> <!--Permet de rendre obligatoire le champs e-mail-->
            
            <label for="password">Mot de passe</label>
            <input class="force-blanc" type="password" name="password" id="password" required> <!--Permet de rendre obligatoire le champ mot de passe-->

            <button type="submit" class="bouton">S'inscrire</button>
        </form>

        <p>Déjà inscrit ? <a href="index.php?action=loginUser">Connectez-vous</a></p> <!-- Redirige vers la mire de connexion -->
    </div>

    <img src="images/Mask_group.png" alt="Photo de plusieurs livres">
</section>