<?php

/**
 * Classe abstraite qui représente un manager. Elle récupère automatiquement le gestionnaire de base de données. 
 */
abstract class AbstractEntityManager
{
    protected PDO $db;

    /**
     * Constructeur de la classe.
     * Il récupère automatiquement l'instance de DBManager. 
     */
    public function __construct()
    {
       $this->db = DBManager::getInstance()->getPDO();
    }
}