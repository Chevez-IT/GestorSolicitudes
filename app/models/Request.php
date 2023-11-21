<?php

namespace Model;

class Request
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function getRequests()
    {
        $stmt = $this->db->prepare("CALL SelectAllRequests()");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateRequestEmployee($request_id, $request_assessment, $request_status, $user_employee_id)
    {
        $stmt = $this->db->prepare("CALL UpdateRequestEmployee(:request_id, :request_assessment, :request_status, :user_employee_id)");
        $stmt->bindParam(':request_id', $request_id);
        $stmt->bindParam(':request_assessment', $request_assessment);
        $stmt->bindParam(':request_status', $request_status);
        $stmt->bindParam(':user_employee_id', $user_employee_id);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Exito']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error']);
        }
    }


    public function updateRequestStatus($request_id, $request_status)
    {
        $stmt = $this->db->prepare("CALL UpdateRequestStatus(:request_id, :request_status)");
        $stmt->bindParam(':request_id', $request_id);
        $stmt->bindParam(':request_status', $request_status);

        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Exito']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error']);
        }
    }

    public function createRequest(
        $request_id,
        $user_id_customer,
        $request_art,
        $request_support,
        $request_production_date,
        $request_production_time,
        $request_final_production_date,
        $request_details,
        $request_purpose,
        $request_reference,
        $request_additional_comments,
        $request_assessment,
        $user_id_employee,
        $request_status
    ) {
        $stmt = $this->db->prepare("CALL CreateRequest(
            :request_id,
            :user_id_customer,
            :request_art,
            :request_support,
            :request_production_date,
            :request_production_time,
            :request_final_production_date,
            :request_details,
            :request_purpose,
            :request_reference,
            :request_additional_comments,
            :request_assessment,
            :user_id_employee,
            :request_status
        )");

        $stmt->bindParam(':request_id', $request_id);
        $stmt->bindParam(':user_id_customer', $user_id_customer);
        $stmt->bindParam(':request_art', $request_art);
        $stmt->bindParam(':request_support', $request_support);
        $stmt->bindParam(':request_production_date', $request_production_date);
        $stmt->bindParam(':request_production_time', $request_production_time);
        $stmt->bindParam(':request_final_production_date', $request_final_production_date);
        $stmt->bindParam(':request_details', $request_details);
        $stmt->bindParam(':request_purpose', $request_purpose);
        $stmt->bindParam(':request_reference', $request_reference);
        $stmt->bindParam(':request_additional_comments', $request_additional_comments);
        $stmt->bindParam(':request_assessment', $request_assessment);
        $stmt->bindParam(':user_id_employee', $user_id_employee);
        $stmt->bindParam(':request_status', $request_status);

        // Ejecutar la consulta
        $result = $stmt->execute();

        if ($result) {
            return json_encode(['status' => true, 'message' => 'Exito']);
        } else {
            return json_encode(['status' => false, 'message' => 'Error']);
        }
    }
}
