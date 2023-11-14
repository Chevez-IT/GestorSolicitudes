<?php

use Core\Database;
use Model\Authentication;
use Core\Tools;

class AuthenticateController
{

    private $authModel;
    private $tools;

    const DASHBOARD_VIEW = 'dashboard.index';
    const CREATE_VIEW_LOGIN = 'index';

    public function __construct()
    {
        $db = new Database();
        $db->connect();
        $this->authModel = new Authentication($db->getConnection());
        $this->tools = new Tools();
    }



    public function user_auth()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Obtiene los datos del formulario
            $email = $this->tools->sanitize($_POST['email']);
            $password = $this->tools->sanitize($_POST['password']);

            $fieldsToValidate = [
                'email' => $email,
                'password' => $password
            ];

            // Valida los campos y obtiene los errores
            $errors = $this->tools->validateFields($fieldsToValidate);

            // Si hay errores, se prepara el arreglo $data con los errores y los valores de los campos
            if (!empty($errors)) {
                // los mensajes de error deberían asignarse correctamente al arreglo $data y mostrarse en la vista.
                $data = $fieldsToValidate;
                $data['error'] = [];
                foreach ($errors as $field => $error) {
                    $data['error'][$field] = ['message' => $error];
                }

                return view(self::CREATE_VIEW_LOGIN, $data); // Renderiza la vista con los errores
            }

            // Si no hay errores, se procede a crear logueo del usuario
            $response = $this->authModel->login($email, $password);

            // Obtenmos la respuesta del modelo
            $response_auth = json_decode($response, true);

            if ($response_auth['status'] == true) {
                // Borrar los datos después de un envío exitoso
                $_POST = array();
                return view(self::DASHBOARD_VIEW);

            } else {
                // Error al iniciar sesión del usuario
                $data = [
                    "status" => $response_auth['status'],
                    "message" => $response_auth['message'],
                    "email" => $email,
                    "password" => $password
                ];
                return view(self::CREATE_VIEW_LOGIN, $data);
            }

        } else {
            //Intento sin POST
            header("Location: " . url("/"));
            exit(); // Terminar la ejecución del controlador
        }
    }




}