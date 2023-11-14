<?php

namespace Model;

class Authentication
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function login($email, $password)
    {
        try {
            // Validación de datos de entrada
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $stmt = $this->db->prepare("SELECT account_id, role_id , account_password , account_email FROM accounts WHERE account_email = :email");
            $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);


            if ($user && password_verify($password, $user['account_password'])) {

                session_start();
                // Inicio de sesión exitoso
                $_SESSION['user'] = [
                    'id' => $user['account_id'],
                    'user_type' => $user['role_id'],
                    'email' => $user['account_email']
                ];

                $response = [
                    'status' => true,
                    'message' => 'Sesión iniciada',
                    'user_type' => $user['role_id']
                ];

                return json_encode($response);
            } else {
                // Datos de inicio de sesión incorrectos
                $response = [
                    'status' => false,
                    'message' => 'Usuario o contraseña incorrectos',
                ];

                return json_encode($response);
            }
        } catch (\PDOException $e) {
            // Gestión de errores
            error_log('Error en el inicio de sesión: ' . $e->getMessage());
            $response = [
                'status' => false,
                'message' => 'Ha ocurrido un error en el inicio de sesión'
            ];

            return json_encode($response);
        }
    }
}