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

    public function getCompanies()
    {
        $stmt = $this->db->prepare("CALL SelectAllCompanies()");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectCompanyByName($companyName)
    {
        $stmt = $this->db->prepare("CALL SelectCompanyByName(:companyName)");
        $stmt->bindParam(':companyName', $companyName);
        $result = $stmt->execute();

        if ($result) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return ['status' => false, 'message' => 'Empresa no encontrada'];
        }
    }

    public function selectCompanyByID($companyID)
    {
        $stmt = $this->db->prepare("CALL SelectCompanyByID(:companyID)");
        $stmt->bindParam(':companyID', $companyID);
        $result = $stmt->execute();

        if ($result) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return ['status' => false, 'message' => 'Empresa no encontrada'];
        }
    }
}
