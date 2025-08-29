<?php

class MessageController
{
    public function showMessages()
    {
        // Vérifie si l'utilisateur est connecté, sinon redirige vers la page de login//
        if (!isset($_SESSION['user'])) {
            Utils::redirect("loginUser");
            return;
        }

        // Récupère l'utilisateur connecté et son ID//
        $user = $_SESSION['user'];
        $userId = $user->getId();

        // Instancie le manager des messages//
        $messageManager = new MessageManager();

        // Récupère la liste des conversations de l'utilisateur//
        $conversations = $messageManager->getUserConversations($userId);


        // Récupère l'ID de l'autre utilisateur passé en GET pour afficher la conversation spécifique//
        $otherUserId = isset($_GET['user']) ? (int)$_GET['user'] : null;
        $messages = [];


        if ($otherUserId) {
            // Récupère les messages échangés entre l'utilisateur connecté et l'autre utilisateur//
            $messages = $messageManager->getMessagesBetweenUsers($userId, $otherUserId);
            
        
        }

        // Prépare et affiche la vue "messagerie" en lui passant les données//
        $view = new View("Messagerie");
        $view->render("messagerie", [
            'conversations' => $conversations,
            'messages' => $messages,
            'userId' => $userId,
            'otherUserId' => $otherUserId,
        ]);
    }

    public function sendMessage()
    {
        // Vérifie que l'utilisateur est connecté//
        if (!isset($_SESSION['user'])) {
            Utils::redirect("loginUser");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_SESSION['user'];
            $userId = $user->getId();

            // Récupère le destinataire et le message envoyés via POST//
            $recipientId = isset($_POST['recipient_id']) ? (int)$_POST['recipient_id'] : null;
            $messageContent = trim($_POST['message'] ?? '');

            if ($recipientId && $messageContent !== '') {
                $messageManager = new MessageManager();

                // Vérifie si une conversation existe déjà entre les deux utilisateurs//
                $conversation = $messageManager->getConversationByUserIds($userId, $recipientId);
                if (!$conversation) {
                    // Sinon, crée une nouvelle conversation et récupère son ID//
                    $conversationId = $messageManager->createConversation($userId, $recipientId);
                } else {
                    $conversationId = $conversation['id'];
                }

                // Envoie le message en le liant à la conversation //
                $messageManager->sendMessage($conversationId, $userId, $messageContent);
            }
        }

        // Redirige vers la messagerie ou le message ouvert //
        Utils::redirect('messagerie', ['user' => $recipientId]);
    }
}