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

            <h4>Description</h4>
            <p class="description"><?= nl2br(htmlspecialchars($book->getDescription())) ?></p>

            <h4>Propriétaire</h4>
            <div class="proprietaire">
                <img src="images/pictures/<?= htmlspecialchars($user->getPictureUser()) ?>" alt="Photo de profil de <?= htmlspecialchars($user->getPseudo()) ?>" class="photo-profil">
                <p><a href="index.php?action=userBooks&user_id=<?= htmlspecialchars($user->getId()) ?>"><?= htmlspecialchars($user->getPseudo()) ?></a></p>
            </div>

            <a href="#" class="bouton">Envoyer un message</a>
        </div>
    </div>
</section>