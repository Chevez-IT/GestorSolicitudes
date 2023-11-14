<?php

namespace Model;

class Company
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // En tu modelo
    public function createCompany($company_id, $company_name, $company_status)
    {
        $stmt = $this->db->prepare("CALL CreateCompany(:company_id, :company_name, :company_status)");
        $stmt->bindParam(':company_id', $company_id);
        $stmt->bindParam(':company_name', $company_name);
        $stmt->bindParam(':company_status', $company_status);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Empresa creada exitosamente']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error al crear la empresa']);
        }
    }

    
}
