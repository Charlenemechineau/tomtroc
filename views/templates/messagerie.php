<!-- template page de messagerie -->

<section id="messagerie">
  <div class="conteneur-messagerie">

    <!-- Liste des conversations à gauche -->
    <div class="liste-conversations">
      <h2 id="titre-messagerie">Messagerie</h2>

      <?php if (!empty($conversations)) : ?>
        <?php foreach ($conversations as $conv) : ?>
          <div class="element-conversation <?= ($otherUserId == $conv['participant_id']) ? 'active' : '' ?>">
            <a href="index.php?action=messagerie&user=<?= (int)$conv['participant_id'] ?>" class="lien-conversation">
              <img src="images/pictures/<?= htmlspecialchars($conv['picture_user']) ?>" alt="Photo de profil" class="photo-profil">

              <div class="infos-principales">
                <p class="pseudo-utilisateur"><?= htmlspecialchars($conv['pseudo']) ?></p>
                <p class="dernier-message"><?= htmlspecialchars($conv['last_message'] ?? 'Aucun message') ?></p>
              </div>

              <p class="heure-dernier-message"><?= date('H:i', strtotime($conv['last_message_date'] ?? '')) ?></p>
            </a>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <p>Aucune conversation pour le moment.</p>
      <?php endif; ?>
    </div>

    <!-- Zone de chat à droite -->
    <div class="zone-chat">
      
      <?php if ($otherUserId) : ?>
        <!-- En-tête de la conversation -->
        <div class="entete-conversation">
          <?php 
          // Trouve les infos de l'interlocuteur
          $interlocuteur = null;
          foreach ($conversations as $conv) {
            if ($conv['participant_id'] == $otherUserId) {
              $interlocuteur = $conv;
              break;
            }
          }
          ?>
          <?php if ($interlocuteur) : ?>
            <img src="images/pictures/<?= htmlspecialchars($interlocuteur['picture_user']) ?>" alt="Photo de profil" class="photo-profil">
            <span class="nom-interlocuteur"><?= htmlspecialchars($interlocuteur['pseudo']) ?></span>
          <?php endif; ?>
        </div>

        <!-- Zone des messages -->
        <div class="messages-container">
          <?php if (!empty($messages)) : ?>
            <?php foreach ($messages as $message) : ?>
              <?php $isSent = ((int)$message['sender_id'] === (int)$userId); ?>
              <div class="message-wrapper <?= $isSent ? 'message-envoye' : 'message-recu' ?>">

                <!-- Ligne avatar + heure -->
                <div class="message-header">
                  <?php if (!$isSent): ?>
                    <!-- Afficher l’avatar uniquement pour les messages reçus -->
                    <img src="images/pictures/<?= htmlspecialchars($message['picture_user']) ?>"
                        alt="Photo de profil" class="photo-profil">
                  <?php endif; ?>
                  <span class="message-heure">
                    <?= date('d.m H:i', strtotime($message['sent_date'])) ?>
                  </span>
                </div>

                <!-- Bulle -->
                <div class="message-bulle">
                  <div class="message-texte"><?= htmlspecialchars($message['message'] ?? '') ?></div>
                </div>

              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        
        <!-- Formulaire d'envoi -->
        <div class="zone-saisie">
          <form method="POST" action="index.php?action=sendMessage" class="form-envoi">
            <input type="hidden" name="recipient_id" value="<?= (int)$otherUserId ?>">
            <input type="text" name="message" placeholder="Tapez votre message ici" class="champ-message" required>
            <button type="submit" class="bouton">Envoyer</button>
          </form>
        </div>

      <?php else : ?>
        <!-- Message par défaut si aucune conversation sélectionnée -->
        <div class="aucune-conversation">
          <p>Sélectionnez une conversation pour commencer à discuter</p>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>