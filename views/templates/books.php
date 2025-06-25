<!-- Template de l'affiche de tous les livres -->

<!--section nos livres à l'échange-->
<section id="section-echanges">
    <div class="contenu-echange">
        <h1>Nos livres à l'échange</h1>

        <!--Formulaire de recherche-->
        <form method="GET" action="index.php">
            <input type="hidden" name="action" value="rechercheLivres">
            <div class= "champ-recherche-wrapper">
                <img src="images/Union.png" alt="Rechercher" class="icone-loupe">
            <input 
                type="text" 
                name="recherche" 
                placeholder="Rechercher un livre..." 
                value="<?= htmlspecialchars($_GET['recherche'] ?? '') ?>" 
                class="champ-recherche"
            >
            </div>
        </form>
    </div>

     <!-- Vérification s'il y a des livres dans la variable $books -->
    <?php if (!empty($books)): ?>
        <div class="livres">
            <?php foreach ($books as $book): ?>
                <a>
                    <article class="carte-livre carte-livre-bibliotheque">
                        <img src="images/<?= htmlspecialchars($book->getImage()) ?>" alt="Couverture de <?= htmlspecialchars($book->getTitle()) ?>">
                        <h3><?= htmlspecialchars($book->getTitle()) ?></h3>
                        <p class="auteur"><?= htmlspecialchars($book->getAuthor()) ?></p>
                        <?php if ($book->getDisponibilite() !== 'disponible'): ?>
                            <span class="banniere-non-dispo">Non disponible</span>
                        <?php endif; ?>
                    </article>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Message si aucun livre n'est disponible -->
        <p>Aucun livre disponible pour le moment.</p>
    <?php endif; ?>
</section>