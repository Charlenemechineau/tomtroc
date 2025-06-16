<?php

 class Book extends AbstractEntity
 {
     private string $title;


     public function setTitle(string $title): void
     {
         $this->title = $title;
     }

     public function getTitle(): string
     {
         return $this->title;
     }

 }