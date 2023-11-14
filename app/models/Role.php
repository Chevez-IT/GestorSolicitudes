<?php

namespace Model;

class Role
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getRoles()
    {
        $stmt = $this->db->prepare("CALL SelectAllRoles()");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createRole($role_id, $role_name, $role_status)
    {
        $stmt = $this->db->prepare("CALL CreateRole(:role_id, :role_name, :role_status)");
        $stmt->bindParam(':role_id', $role_id);
        $stmt->bindParam(':role_name', $role_name);
        $stmt->bindParam(':role_status', $role_status);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Rol creado exitosamente']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error al crear el rol']);
        }
    }

    public function selectRoleByName($roleName)
    {
        $stmt = $this->db->prepare("CALL SelectRolesByRoleName(:roleName)");
        $stmt->bindParam(':roleName', $roleName);
        $result = $stmt->execute();

        if ($result) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return ['status' => false, 'message' => 'Rol no encontrado'];
        }
    }

    public function selectRoleByID($roleID)
    {
        $stmt = $this->db->prepare("CALL SelectRoleByID(:roleID)");
        $stmt->bindParam(':roleID', $roleID);
        $result = $stmt->execute();

        if ($result) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return ['status' => false, 'message' => 'Rol no encontrado'];
        }
    }

    public function updateRoleStatus($role_id, $role_status)
    {
        $stmt = $this->db->prepare("CALL UpdateRoleStatus(:role_id, :role_status)");
        $stmt->bindParam(':role_id', $role_id);
        $stmt->bindParam(':role_status', $role_status);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Estado del rol actualizado exitosamente']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error al actualizar el estado del rol']);
        }
    }
}