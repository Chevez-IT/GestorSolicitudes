<?php

namespace Model;

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUsers()
    {
        $stmt = $this->db->prepare("CALL SelectAllUsers()");
        $stmt->execute();
        return $stmt->fetchAll();
    }



}




