<?php

namespace Model;

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser($user_id, $account_id, $user_names, $user_surnames, $user_address, $user_phone, $company_id, $user_position, $user_area, $user_status)
    {
        $stmt = $this->db->prepare("CALL CreateUser(:user_id, :account_id, :user_names, :user_surnames, :user_address, :user_phone, :company_id, :user_position, :user_area, :user_status)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':account_id', $account_id);
        $stmt->bindParam(':user_names', $user_names);
        $stmt->bindParam(':user_surnames', $user_surnames);
        $stmt->bindParam(':user_address', $user_address);
        $stmt->bindParam(':user_phone', $user_phone);
        $stmt->bindParam(':company_id', $company_id);
        $stmt->bindParam(':user_position', $user_position);
        $stmt->bindParam(':user_area', $user_area);
        $stmt->bindParam(':user_status', $user_status);


        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Usuario creada exitosamente']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error al crear la usuario']);
        }
    }

    public function getUsers()
    {
        $stmt = $this->db->prepare("CALL SelectAllUsers()");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
