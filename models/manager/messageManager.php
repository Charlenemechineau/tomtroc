<?php

class MessageManager extends AbstractEntityManager
{
    /**
     * Affiche dans la colonne de gauche la liste des conversations de l’utilisateur connecté
     * Récupère toutes les conversations d'un utilisateur, avec :
     *  - les infos de l'autre participant (id, pseudo, picture_user),
     *  - le dernier message (texte),
     *  - la date du dernier message.
     *  - 
     * @param int $userId L'identifiant de l'utilisateur connecté.
     * @return array Liste de conversations (tableaux associatifs).
     */
    public function getUserConversations(int $userId): array
    {
        $sql = "
            SELECT 
                c.id AS conversation_id,
                u.id AS participant_id,
                u.pseudo,
                u.picture_user,
                (SELECT m.message 
                FROM messages m 
                WHERE m.conversation_id = c.id 
                ORDER BY m.sent_date DESC 
                LIMIT 1) AS last_message,
                (SELECT m.sent_date 
                FROM messages m 
                WHERE m.conversation_id = c.id 
                ORDER BY m.sent_date DESC 
                LIMIT 1) AS last_message_date,
                (SELECT m.sender_id
                FROM messages m
                WHERE m.conversation_id = c.id
                ORDER BY m.sent_date DESC
                LIMIT 1) AS last_sender_id
            FROM conversations c
            JOIN users u ON (u.id = c.user1_id OR u.id = c.user2_id)
            WHERE (c.user1_id = :userId OR c.user2_id = :userId)
            AND u.id <> :userId
            ORDER BY last_message_date DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Affiche le fil de discussion d’une conversation
     * Récupère tous les messages d'une conversation (ordre chronologique naturel).
     * @param int $conversationId ID de la conversation
     * @return array Liste de messages (id, message, sender_id, pseudo, picture_user, sent_date)
     */
    public function getMessages($conversationId) {
        $stmt = $this->db->prepare("
            SELECT m.id, m.message, m.sender_id, u.pseudo, u.picture_user, m.sent_date
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            WHERE m.conversation_id = :conversationId
            ORDER BY m.sent_date ASC
        ");
        $stmt->bindParam(':conversationId', $conversationId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les messages échangés entre deux utilisateurs spécifiques.
     * Utile quand on n'a pas encore l'ID de la conversation :
     *  - renvoie aussi c.id AS conversation_id pour réutilisation directe.
     *
     * @param int $user1Id ID utilisateur A
     * @param int $user2Id ID utilisateur B
     * @return array Liste des messages + conversation_id
     */
    public function getMessagesBetweenUsers($user1Id, $user2Id) {
        $stmt = $this->db->prepare("
            SELECT m.id, m.message, m.sender_id, u.pseudo, u.picture_user, m.sent_date,
            c.id as conversation_id
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            JOIN conversations c ON m.conversation_id = c.id
            WHERE ((c.user1_id = :user1Id AND c.user2_id = :user2Id)
            OR  (c.user1_id = :user2Id AND c.user2_id = :user1Id))
            ORDER BY m.sent_date ASC
        ");
        $stmt->bindParam(':user1Id', $user1Id, PDO::PARAM_INT);
        $stmt->bindParam(':user2Id', $user2Id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    /**
     * Envoie un message dans une conversation existante.
     * Met aussi à jour la date du dernier message dans la table conversations
     * (last_message_at) pour garder l'ordre d'affichage correct.
     *
     * @param int $conversationId L'identifiant de la conversation.
     * @param int $senderId       L'identifiant de l'expéditeur.
     * @param string $message     Le contenu du message.
     * @return bool true si l'insertion a réussi, sinon false.
     */
    public function sendMessage($conversationId, $senderId, $message) {
        $stmt = $this->db->prepare("
            INSERT INTO messages (conversation_id, sender_id, message, sent_date)
            VALUES (:conversationId, :senderId, :message, NOW())
        ");
        $stmt->bindParam(':conversationId', $conversationId, PDO::PARAM_INT);
        $stmt->bindParam(':senderId', $senderId, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $result = $stmt->execute();

        if ($result) {
            // Mettre à jour la date du dernier message dans conversations
            $update = $this->db->prepare("UPDATE conversations SET last_message_at = NOW() WHERE id = :conversationId");
            $update->bindParam(':conversationId', $conversationId, PDO::PARAM_INT);
            $update->execute();
        }

        return $result;
    }
    // Vérifie s'il existe déjà une conversation entre 2 utilisateurs.
    // Retourne ['id' => <id>] si trouvée, sinon null.
    public function getConversationByUserIds(int $user1Id, int $user2Id): ?array
    {
        $sql = "
            SELECT id
            FROM conversations
            WHERE (user1_id = :u1 AND user2_id = :u2)
            OR (user1_id = :u2 AND user2_id = :u1)
            LIMIT 1
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':u1', $user1Id, PDO::PARAM_INT);
        $stmt->bindValue(':u2', $user2Id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
    /**
     * Crée une nouvelle conversation entre deux utilisateurs.
     * Initialise created_at et last_message_at à NOW().
     *
     * @param int $user1Id ID du premier utilisateur.
     * @param int $user2Id ID du second utilisateur.
     * @return int L'ID de la conversation nouvellement créée.
     */
    public function createConversation($user1Id, $user2Id) {
        $stmt = $this->db->prepare("
            INSERT INTO conversations (user1_id, user2_id, created_at, last_message_at)
            VALUES (:user1Id, :user2Id, NOW(), NOW())
        ");
        $stmt->bindParam(':user1Id', $user1Id, PDO::PARAM_INT);
        $stmt->bindParam(':user2Id', $user2Id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

}