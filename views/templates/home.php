<!-- Template de la page d'acceuil -->
 <section id="section-decouverte" >
    <div class="conteneur-decouverte">
        <h1 id="titre-decouverte">Rejoignez nos lecteurs passionnés</h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres</p>
        <a href="index.php?action=books" class="bouton">Découvrir</a>
    </div>
    <div class="illustration-decouverte">
        <img src="./images/hamza-nouasria.webp" alt="photo d'une devanture d'un batiment avec beaucoup de livre et un homme qui lit" class="img-decouverte">
        <p>hamza</p>   
    </div>
</section>













<div>
    <?php
    /** @var Book[] $books */
    foreach ($books as $key => $book) {
        echo  $book->getTitle();
    }
    ?>
</div>