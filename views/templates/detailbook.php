<!-- Vue du détail d'un livre -->

<section id="details-livre">
    <p class="fil-ariane">
        <a href="index.php?action=books">Nos livres</a> > 
        <span><?= htmlspecialchars($book->getTitle()) ?></span>
    </p>

    <div class="contenu-detail">

        <!-- Image de couverture -->
        <img src="images/<?= htmlspecialchars($book->getImage()) ?>" alt="Couverture de <?= htmlspecialchars($book->getTitle()) ?>" id="image-livre">

        <!-- Infos du livre -->
        <div class="infos-livre">
            <h1><?= htmlspecialchars($book->getTitle()) ?></h1>
            <p class="auteur">par <?= htmlspecialchars($book->getAuthor()) ?></p>
            <p class="separateur">______</p>
            <!-- Description du livre-->
            <h4>Description</h4>
            <p class="description"><?= nl2br(htmlspecialchars($book->getDescription())) ?></p>

            <!--Propriétaire du livre page de profil-->
            <h4>Propriétaire</h4>
            <div class="proprietaire">
                <img src="images/pictures/<?= htmlspecialchars($user->getPictureUser()) ?>" alt="Photo de profil de <?= htmlspecialchars($user->getPseudo()) ?>" class="photo-profil">
                <p>
                    <a href="index.php?action=userProfile&id=<?= (int)$user->getId() ?>" class="lien-profil">
                    <?= htmlspecialchars($user->getPseudo()) ?>
                    </a>
                </p>
            </div>
            <!-- ecrire directement au propriétaire du livre-->
            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?action=messagerie&user=<?= (int)$user->getId() ?>" class="bouton">
                    Envoyer un message
                </a>
            <?php else: ?>
                <a href="index.php?action=loginUser" class="bouton">
                    Envoyer un message
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>