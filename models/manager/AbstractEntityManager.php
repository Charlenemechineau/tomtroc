<?php


abstract class AbstractEntityManager
{
    protected PDO $db;

    public function __construct()
    {
       $this->db = DBManager::getInstance()->getPDO();
    }
}