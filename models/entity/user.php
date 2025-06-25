<?php
//Classe représentant un utilisateur notamment en récupérant les données depuis la base de données.
// Elle hérite d'AbstractEntityManager qui contient la connexion $db.

class User extends AbstractEntity
{
    private string $pseudo;
    private string $email;
    private string $password;
    private string $created_at;

    // Getters et Setters
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }
}
