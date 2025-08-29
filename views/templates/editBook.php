<!-- TEMPLATE : page édition d'un livre -->
<section id="edition-livre">

  <div class="entete-edition">
    <a class="fil-ariane-retour" href="index.php?action=myAccount">
      <i class="fa-solid fa-arrow-left"></i> retour
    </a>
    <h2 id="titre-edition-livre">Modifier les informations</h2>
  </div>

  <div class="conteneur-edition">

    <!-- Colonne gauche : photo -->
    <div class="bloc-photo-livre">
      <p>Photo</p>

      <?php
        $pictureFile = $book->getImage();
        $picturePath = "images/" . htmlspecialchars($pictureFile ?: "");
      ?>

      <?php if (!empty($pictureFile)): ?>
        <img src="<?= $picturePath ?>" alt="Photo de couverture" class="photo-livre__img">
      <?php else: ?>
        <div class="photo-livre__placeholder">Aucune image</div>
      <?php endif; ?>

      <form action="index.php?action=updateBookImage" method="post" enctype="multipart/form-data">
        <input type="hidden" name="book_id" value="<?= (int)$book->getId() ?>">
        <label for="book_picture" class="bouton-fichier">Modifier la photo</label>
        <input type="file" id="book_picture" name="book_picture" accept="image/*" onchange="this.form.submit()">
      </form>
    </div>

    <!-- Colonne droite : formulaire texte -->
    <div class="formulaire-edition">
      <form action="index.php?action=updateBookDetails" method="post">
        <input type="hidden" name="book_id" value="<?= (int)$book->getId() ?>">

        <label for="title">Titre</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($book->getTitle()) ?>" required>

        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" value="<?= htmlspecialchars($book->getAuthor()) ?>" required>

        <label for="description">Commentaire</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($book->getDescription()) ?></textarea>

        <label for="disponibilite">Disponibilité</label>
        <select id="disponibilite" name="disponibilite" required>
          <option value="Disponible"     <?= $book->getDisponibilite() === 'Disponible' ? 'selected' : '' ?>>Disponible</option>
          <option value="Pas disponible" <?= $book->getDisponibilite() === 'Pas disponible' ? 'selected' : '' ?>>Pas disponible</option>
        </select>

        <button type="submit" class="bouton-edit">Valider</button>
      </form>
    </div>

  </div>
</section>