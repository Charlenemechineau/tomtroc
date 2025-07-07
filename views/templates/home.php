<!-- Template de la page d'acceuil -->


<!-- Section découverte -->
<section id="section-decouverte">
    <div class="conteneur-decouverte">
        <h1> Rejoignez nos lecteurs passionnés</h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres</p>
        <a href="index.php?action=books" class="bouton">Découvrir</a>
    </div>
    <div class="illustration-decouverte">
        <img src="./images/hamza-nouasria.webp" alt="photo d'une devanture d'un batiment avec beaucoup de livre et un homme qui lit" class="img-decouverte">
        <p>hamza</p>   
    </div>
</section>

<!-- Section Livres -->
<section id="section-livres">
    <h2>Les derniers livres ajoutés</h2>
    <div class="cartes-livres">
        <?php
        /** @var Book[] $books */
        foreach ($books as $book):
        ?>
            <a href="index.php?action=detailBook&id=<?= htmlspecialchars($book->getId()) ?>">
                <article class="carte-livre">
                    <img src="images/<?= htmlspecialchars($book->getImage()) ?>" alt="Couverture de <?= htmlspecialchars($book->getTitle()) ?>">
                    <h3><?= htmlspecialchars($book->getTitle()) ?></h3>
                    <p class="auteur"><?= htmlspecialchars($book->getAuthor()) ?></p>
                </article>
            </a>
        <?php
        endforeach;
        ?>
    </div>
    <a href="index.php?action=books" class="bouton">Voir tous les livres</a>
</section>

<!--Section infos -->
<section class="section-infos">
    <h2>Comment ça marche</h2>
    <p class="intro">Échanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commencer :</p>
    <div class="etapes">
        <div class="point">Inscrivez-vous gratuitement sur notre plateforme.</div>
        <div class="point">Ajoutez les livres que vous souhaitez échanger à votre profil.</div>
        <div class="point">Parcourez les livres disponibles chez d'autres membres.</div>
        <div class="point">Proposez un échange et discutez avec d'autres passionnés de lecture.</div>
    </div>
    <a href="index.php?action=books" class="bouton-clair">Voir tous les livres</a>
</section>

<!-- Sestion Valeurs -->
<section class="valeurs">
    <div class="banniere">
        <img src="./images/banner.png" alt="photo d'une femme dans une bibliothéque">
    </div>

    <div class="a-propos">
        <h2>Nos Valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.<br />
        <br />
        Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. <br />
        <br />
        Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p><br />
        <p class="equipe">L'équipe Tom Troc</p>
    </div>   
        
        <img src="./images/vector_2.svg" alt="image d'un coeur" class="coeur">
</section>
