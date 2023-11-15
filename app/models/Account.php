<?php

namespace Model;

class Account
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function getAccounts()
    {
        $stmt = $this->db->prepare("CALL SelectAllAccounts()");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}