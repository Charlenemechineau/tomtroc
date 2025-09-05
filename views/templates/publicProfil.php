<!--Template profil utilisateur -->

<section class="section-mon-compte-bis" id="profil-public">

    <div class="conteneur-compte">
        <!-- Colonne gauche : avatar + infos + bouton message -->
        <div class="bloc-gauche">
        <?php
            $defaultPicturePath = "images/pictures/default.webp";
            $picturePath = !empty($user->getPictureUser())
            ? "images/pictures/" . $user->getPictureUser()
            : $defaultPicturePath;
        ?>
        <img src="<?= htmlspecialchars($picturePath) ?>" alt="Photo de profil" class="image-profil">


        <p class="ligne-separation-bis">_________________________________________</p>

        <h2 class="pseudo-profil"><?= htmlspecialchars($user->getPseudo()) ?></h2>

        <?php
            $dateInscriptionTxt = !empty($membreDepuis)
            ? "Membre depuis $membreDepuis"
            : "Membre depuis le " . date('d/m/Y', strtotime($user->getCreatedAt()));
        ?>
        <p class="membre-depuis"><?= htmlspecialchars($dateInscriptionTxt) ?></p>

        <h4 class="titre-bibliotheque">Bibliothèque</h4>
        <div class="infos-bibliotheque">
            <img class="icon-biblio" src="images/vector-biblio.svg" alt="icone bibliothéque livre">
            <p class="nb-livres"><?= (int)$bookCount ?> livre<?= $bookCount > 1 ? 's' : '' ?></p>
        </div>

        <!-- Bouton écrire un message (ouvre ta messagerie avec cet utilisateur) -->
        <a href="index.php?action=messagerie&user=<?= (int)$user->getId() ?>" class="bouton-clair">
            Écrire un message
        </a>
        </div>

        <!-- Colonne droite : tableau des livres  -->
        <div class="bloc-droit-bis">
        <div class="section-voslivres-bis">
            <table class="tableau-livres table-zebra">
            <thead>
                <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($books)): ?>
                <tr>
                    <td colspan="4" class="aucun-livre">Aucun livre pour le moment.</td>
                </tr>
                <?php else: ?>
                <?php $i = 0; ?>
                <?php foreach ($books as $book): ?>
                    <tr class="<?= $i % 2 === 0 ? 'ligne-paire' : 'ligne-impaire' ?>">
                    <td>
                        <?php
                        $img = $book->getImage();
                        $imgPath = !empty($img) ? "images/" . $img : "images/placeholder-book.png";
                        ?>
                        <img src="<?= htmlspecialchars($imgPath) ?>"
                            alt="<?= htmlspecialchars($book->getTitle()) ?>"
                            class="livre-miniature">
                    </td>
                    <td>
                        <a href="index.php?action=detailBook&id=<?= (int)$book->getId() ?>">
                        <?= htmlspecialchars($book->getTitle()) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                    <td>
                        <?php
                        $description = htmlspecialchars($book->getDescription());
                        echo strlen($description) > 120 ? substr($description, 0, 120) . '…' : $description;
                        ?>
                    </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>

</section>