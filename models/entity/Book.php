<?php
// Classe représentant un livre, avec ses propriétés et méthodes d'accès.//
// Hérite d'AbstractEntity.//
 class Book extends AbstractEntity
 {
    private string $title;
    private string $author;
    private string $description;
    private string $image;
    private string $disponibilite;
    private int $user_id;
    private string $pseudo;
    private string $pictureUser;

    

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getDisponibilite(): string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): void
    {
        $this->disponibilite = $disponibilite;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getPseudo(): string {
    return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void {
        $this->pseudo = $pseudo;
    }

    public function getPictureUser(): string {
        return $this->pictureUser;
    }

    public function setPictureUser(string $pictureUser): void {
        $this->pictureUser = $pictureUser;
    }
}