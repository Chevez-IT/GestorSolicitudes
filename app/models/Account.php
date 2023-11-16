<?php

namespace Model;

class Account
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createAccount($account_id, $account_name, $account_email, $account_password, $role_id, $account_status)
    {
        $stmt = $this->db->prepare("CALL CreateAccount(:account_id, :account_name, :account_email, :account_password, :role_id, :account_status)");
        $stmt->bindParam(':account_id', $account_id);
        $stmt->bindParam(':account_name', $account_name);
        $stmt->bindParam(':account_email', $account_email);
        $stmt->bindParam(':account_password', $account_password);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->bindParam(':account_status', $account_status);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Cuenta creada exitosamente']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error al crear la cuenta']);
        }
    }


    public function getAccounts()
    {
        $stmt = $this->db->prepare("CALL SelectAllAccounts()");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectAccountByID($accountID)
    {
        $stmt = $this->db->prepare("CALL SelectAccountByID(:accountID)");
        $stmt->bindParam(':accountID', $accountID);
        $result = $stmt->execute();

        if ($result) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return ['status' => false, 'message' => 'Cuenta no encontrada'];
        }
    }

    public function updateAccountStatus($account_id, $account_status)
    {
        $stmt = $this->db->prepare("CALL UpdateAccountStatus(:account_id, :account_status)");
        $stmt->bindParam(':account_id', $account_id);
        $stmt->bindParam(':account_status', $account_status);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Estado actualizado exitosamente']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error al actualizar el estado']);
        }
    }

    public function updateAccount($account_id, $account_name, $account_email, $account_role)
    {
        $stmt = $this->db->prepare("CALL UpdateAccountByID(:account_id, :account_name, :account_email, :account_role)");
        $stmt->bindParam(':account_id', $account_id);
        $stmt->bindParam(':account_name', $account_name);
        $stmt->bindParam(':account_email', $account_email);
        $stmt->bindParam(':account_role', $account_role);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Actualizado exitosamente']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error al actualizar']);
        }
    }
}
