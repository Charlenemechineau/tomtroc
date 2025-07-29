<section class="section-mon-compte">

    <h1 class="titre-page-compte">Mon compte</h1>

    <div class="conteneur-compte">
        <!-- Colonne gauche - Profil + photo + bibliothèque -->
        <div class="bloc-gauche">
            <?php
                $defaultPicturePath = "images/pictures/default.webp";
                $picturePath = !empty($user->getPictureUser()) ? "images/pictures/" . $user->getPictureUser() : $defaultPicturePath;
            ?>
            <img src="<?= htmlspecialchars($picturePath) ?>" alt="Photo de profil" class="image-profil">

            <form action="index.php?action=updateProfilePicture" method="post" enctype="multipart/form-data">
                <label for="profile_picture" class="custom-file-upload">modifier</label>
                <input type="file" id="profile_picture" name="profile_picture" onchange="this.form.submit()" accept="image/*" required>
            </form>

            <p class="ligne-separation">_________________________________________</p>

            <h2 class="pseudo-profil"><?= htmlspecialchars($user->getPseudo()) ?></h2>
            <p class="membre-depuis">Membre depuis le <?= date('d/m/Y', strtotime($user->getCreatedAt())) ?></p>

            
                <h4 class="titre-bibliotheque">Bibliothèque</h4>
                <div class="infos-bibliotheque">
                    <img class="icon-biblio" src="images/vector-biblio.svg" alt="icone bibliothéque livre">
                    <p class="nb-livres"><?= count($books) ?> livre<?= count($books) > 1 ? 's' : '' ?></p>
                </div>
        </div>


        <!-- Colonne droite - Formulaire infos utilisateur -->
        <div class="bloc-droit">
            <h3 class="titre-infos">Vos informations personnelles</h3>
            <form action="index.php?action=updateAccount" method="POST" class="formulaire-infos">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="********">

                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($user->getPseudo()) ?>" required>

                <button class="bouton-enregistrement" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>

    <!-- Liste des livres -->
    <div class="section-voslivres">
        <table class="tableau-livres">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>Disponibilité</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($books)): ?>
                    <tr>
                        <td colspan="6" class="aucun-livre">Vous n'avez encore ajouté aucun livre à votre bibliothèque.</td>
                    </tr>
                <?php else: ?>
                    <?php $i = 0; ?>
                    <?php foreach ($books as $book): ?>
                        <tr class="<?= $i % 2 === 0 ? 'ligne-paire' : 'ligne-impaire' ?>">
                        <tr>
                            <td>
                                <img src="images/<?= htmlspecialchars($book->getImage()) ?>" 
                                    alt="<?= htmlspecialchars($book->getTitle()) ?>" 
                                    class="livre-miniature">
                            </td>
                            <td><?= htmlspecialchars($book->getTitle()) ?></td>
                            <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                            <td><?= htmlspecialchars($book->getDescription()) ?></td>
                            <td>
                                <span class="statut-<?= strtolower($book->getDisponibilite()) ?>">
                                    <?= ucfirst(htmlspecialchars($book->getDisponibilite())) ?>
                                </span>
                            </td>
                            <td>
                                <a href="index.php?action=editBook&id=<?= $book->getId() ?>" class="bouton-editer">Éditer</a>
                                <a href="index.php?action=deleteBook&id=<?= $book->getId() ?>" 
                                    class="bouton-supprimer" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</section>