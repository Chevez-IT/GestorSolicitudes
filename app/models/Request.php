<?php

namespace Model;

class Request
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function create($fieldsToValidate)
    {
        try {

            $stmt = $this->db->prepare("INSERT INTO `request` (
                `request_id`, 
                `user_id_customer`, 
                `request_art`, 
                `request_support`, 
                `request_production_date`, 
                `request_production_time`, 
                `request_final_production_date`, 
                `request_details`, 
                `request_purpose`, 
                `request_reference`, 
                `request_additional_comments`, 
                `request_assessment`, 
                `user_id_employee`, 
                `request_status`, 
                `request_creation`, 
                `request_modification`
            ) VALUES (
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
                :request_status, 
                current_timestamp(), 
                :request_modification
            )");
            
            $stmt->bindValue(':request_id', $fieldsToValidate['request_id'], \PDO::PARAM_STR);
            $stmt->bindValue(':user_id_customer', $fieldsToValidate['user_id_customer'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_art', $fieldsToValidate['request_art'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_support', $fieldsToValidate['request_support'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_production_date', $fieldsToValidate['request_production_date'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_production_time', $fieldsToValidate['request_production_time'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_final_production_date', $fieldsToValidate['request_final_production_date'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_details', $fieldsToValidate['request_details'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_purpose', $fieldsToValidate['request_purpose'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_reference', $fieldsToValidate['request_reference'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_additional_comments', $fieldsToValidate['request_additional_comments'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_assessment', $fieldsToValidate['request_assessment'], \PDO::PARAM_STR);
            $stmt->bindValue(':user_id_employee', $fieldsToValidate['user_id_employee'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_status', $fieldsToValidate['request_status'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_modification', $fieldsToValidate['request_modification'], \PDO::PARAM_STR);
            $stmt->execute();

            $request_id = $this->db->lastInsertId();

            $response = [
                'status' => true,
                'message' => 'Solicitud creado.',
                'id_user' => $request_id
            ];

            return json_encode($response);

        } catch (\PDOException $e) {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];

            return json_encode($response);
        }
    }


    public function update($fieldsToValidate)
    {
        try {

            $stmt = $this->db->prepare("UPDATE `request` SET 
            `user_id_customer` = :user_id_customer,
            `request_art` = :request_art,
            `request_support` = :request_support,
            `request_production_date` = :request_production_date,
            `request_production_time` = :request_production_time,
            `request_final_production_date` = :request_final_production_date,
            `request_details` = :request_details,
            `request_purpose` = :request_purpose,
            `request_reference` = :request_reference,
            `request_additional_comments` = :request_additional_comments,
            `request_assessment` = :request_assessment,
            `user_id_employee` = :user_id_employee,
            `request_status` = :request_status,
            `request_modification` = :request_modification
            WHERE `request_id` = :request_id");

            $stmt->bindValue(':request_id', $fieldsToValidate['request_id'], \PDO::PARAM_STR);
            $stmt->bindValue(':user_id_customer', $fieldsToValidate['user_id_customer'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_art', $fieldsToValidate['request_art'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_support', $fieldsToValidate['request_support'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_production_date', $fieldsToValidate['request_production_date'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_production_time', $fieldsToValidate['request_production_time'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_final_production_date', $fieldsToValidate['request_final_production_date'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_details', $fieldsToValidate['request_details'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_purpose', $fieldsToValidate['request_purpose'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_reference', $fieldsToValidate['request_reference'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_additional_comments', $fieldsToValidate['request_additional_comments'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_assessment', $fieldsToValidate['request_assessment'], \PDO::PARAM_STR);
            $stmt->bindValue(':user_id_employee', $fieldsToValidate['user_id_employee'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_status', $fieldsToValidate['request_status'], \PDO::PARAM_STR);
            $stmt->bindValue(':request_modification', $fieldsToValidate['request_modification'], \PDO::PARAM_STR);
            $stmt->execute();

            $response = [
                'status' => true,
                'message' => 'Solicitud actualizada.',
                'id_user' => $fieldsToValidate['request_id']
            ];

            return json_encode($response);

        } catch (\PDOException $e) {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];

            return json_encode($response);
        }
    }


    public function getAllRequest()
    {
        try {
            $stmt = $this->db->prepare("SELECT `user_id` , accounts.account_email , `account_names` , `user_surnames` , `user_address`, `user_phone` , companies.company_name , `user_position` , `user_area` , `user_status`, `user_creation` , `user_modification` FROM `users` INNER JOIN accounts ON users.account_id = accounts.account_id LEFT JOIN companies ON users.company_id = companies.company_id;");
            $stmt->execute();
            $request = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return json_encode($request);
        } catch (\PDOException $e) {
            // Manejo de errores al obtener los usuarios
            // Por ejemplo, registrar el error en un archivo de registro o lanzar una excepción
            return false;
        }
    }






}