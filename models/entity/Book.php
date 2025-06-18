<?php

 class Book extends AbstractEntity
 {
    private string $title;
    private string $author;
    private string $description;
    private string $image;
    private string $disponibilite;
    private int $id_vendeur;

    public function __construct(array $data)
    {
    $this->title = $data['title'];
    $this->author = $data['author'];
    $this->description = $data['description'];
    $this->image = $data['image'];
    $this->disponibilite = $data['disponibilite'];
    $this->id_vendeur = $data['id_vendeur'];
    }

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

    public function getIdVendeur(): int
    {
        return $this->id_vendeur;
    }

    public function setIdVendeur(int $id_vendeur): void
    {
        $this->id_vendeur = $id_vendeur;
    }
}