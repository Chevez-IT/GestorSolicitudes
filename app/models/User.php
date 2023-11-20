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

    public function selectUserByID($user_id)
    {
        $stmt = $this->db->prepare("CALL SelectUserByID(:user_id)");
        $stmt->bindParam(':user_id', $user_id);
        $result = $stmt->execute();

        if ($result) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return ['status' => false, 'message' => 'Usuario no encontrado'];
        }
    }

    public function selectUserByAccountID($account_id)
    {
        $stmt = $this->db->prepare("CALL SelectUserByAccount(:account_id)");
        $stmt->bindParam(':account_id', $account_id);
        $result = $stmt->execute();
        if ($result) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return ['status' => false, 'message' => 'Usuario no encontrado'];
        }
    }

    public function updateUserStatus($user_id, $user_status)
    {
        $stmt = $this->db->prepare("CALL UpdateUserStatus(:user_id, :user_status)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_status', $user_status);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Estado actualizado exitosamente']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error al actualizar el estado']);
        }
    }

    public function updateUser($user_id, $user_names, $user_surnames, $user_address, $user_phone, $company_id, $user_position, $user_area)
    {
        $stmt = $this->db->prepare("CALL UpdateUserByID(:user_id, :user_names, :user_surnames, :user_address, :user_phone, :company_id, :user_position, :user_area)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_names', $user_names);
        $stmt->bindParam(':user_surnames', $user_surnames);
        $stmt->bindParam(':user_address', $user_address);
        $stmt->bindParam(':user_phone', $user_phone);
        $stmt->bindParam(':company_id', $company_id);
        $stmt->bindParam(':user_position', $user_position);
        $stmt->bindParam(':user_area', $user_area);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Actualizado exitosamente']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error al actualizar']);
        }
    }
}
