<?php

use Core\Database;
use Model\Request;
use Core\Tools;
use Model\User;
use Model\Account;

class RequestController
{

    private $tools;
    private $requestModel;
    private $userModel;
    private $accountModel;

    const ERROR_VIEW = 'error.404';
    const INDEX_VIEW = 'request.index';
    const NEW_REQUEST_VIEW = 'request.new-request';
    const PAGE_TITLE = "FGK - MKT & COM";


    public function __construct()
    {
        session_start();
        $db = new Database();
        $db->connect();
        $this->userModel = new User($db->getConnection());
        $this->requestModel = new Request($db->getConnection());
        $this->accountModel = new Account($db->getConnection());
        $this->tools = new Tools();
    }


    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $requests = $this->requestModel->getRequests();
            $users = $this->userModel->getUsers();
            $accounts = $this->accountModel->getAccounts();
            return view(self::INDEX_VIEW, ["pageTitle" => self::PAGE_TITLE, "users" => $users, "requests" => $requests, "accounts" => $accounts]);
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }


    public function updateRequestEmployee()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request_id = $this->tools->sanitize($_POST['request_id']);
            $request_assessment = $this->tools->sanitize($_POST['request_assessment']);
            $user_employee_id = $this->tools->sanitize($_POST['user_id_employee']);

            $response = $this->requestModel->updateRequestEmployee($request_id, $request_assessment, 'Activo', $user_employee_id);

            $response_data = json_decode($response, true);

            if ($response_data['status'] == true) {
                $_SESSION['alert']  = [
                    'title' => "Empleado asignado correctamente",
                    'success' => "Se ha asignado el empleado seleccionado correctamente"
                ];
                header("Location: " . url("/requests"), true, 303);
            } else {
                $_SESSION['alert']  = [
                    'title' => "No se pudo asignar correctamente",
                    'error' => "No se ha asignado el empleado seleccionado correctamente"
                ];
                header("Location: " . url("/requests"));
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function updateRequestStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request_id = $this->tools->sanitize($_POST['request_id']);
            $request_status = $this->tools->sanitize($_POST['request_status']);
            $response = $this->requestModel->updateRequestStatus($request_id, $request_status);

            $response_data = json_decode($response, true);

            if ($response_data['status'] == true) {
                $_SESSION['alert']  = [
                    'title' => "Actualizado correctamente",
                    'success' => "Se ha actualizado el estado correctamente"
                ];
                header("Location: " . url("/requests"), true, 303);
            } else {
                $_SESSION['alert']  = [
                    'title' => "No se pudo actualizado correctamente",
                    'error' => "No se ha actualizado el estado correctamente"
                ];
                header("Location: " . url("/requests"));
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function createRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Generar la request_id
            $request_id = 'RR' . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);

            // Obtener los datos del formulario
            $user_id_customer = 'EG164EG';

            $request_art = $this->tools->sanitize($_POST['request_art']);
            $other_request_art = $this->tools->sanitize($_POST['other_request_art']);
            $final_request_art = $request_art . " : " . $other_request_art;

            $request_support = $this->tools->sanitize($_POST['request_support']);
            $other_request_support = $this->tools->sanitize($_POST['other_request_support']);
            $final_request_support = $request_support . " : " . $other_request_support;

            $request_production_date = $this->tools->sanitize($_POST['request_production_date']);
            $request_production_time = $this->tools->sanitize($_POST['request_production_time']);
            $request_final_production_date = $this->tools->sanitize($_POST['request_final_production_date']);
            $request_details = $this->tools->sanitize($_POST['request_details']);
            $request_purpose = $this->tools->sanitize($_POST['request_purpose']);
            $request_additional_comments = $this->tools->sanitize($_POST['request_additional_comments']);
            $request_assessment = null;
            $user_id_employee = null;
            $request_status = 'En espera'; // O el estado inicial que prefieras

            // Procesar el archivo
            $target_directory = 'files_requests/';
            if (!file_exists($target_directory) && !is_dir($target_directory)) {
                mkdir($target_directory, 0755, true);
            }
            $file_extension = pathinfo($_FILES['request_reference']['name'], PATHINFO_EXTENSION);
            $new_file_name = $request_id . '_' . $user_id_customer . '_' . date('Ymd_His') . '.' . $file_extension;
            $target_path = $target_directory . $new_file_name;

            if (move_uploaded_file($_FILES['request_reference']['tmp_name'], $target_path)) {
                // Llamar al modelo para insertar la solicitud
                $response = $this->requestModel->createRequest(
                    $request_id,
                    $user_id_customer,
                    $final_request_art,
                    $final_request_support,
                    $request_production_date,
                    $request_production_time,
                    $request_final_production_date,
                    $request_details,
                    $request_purpose,
                    $new_file_name,  // Utilizar el nuevo nombre del archivo
                    $request_additional_comments,
                    $request_assessment,
                    $user_id_employee,
                    $request_status
                );

                $response_data = json_decode($response, true);

                if ($response_data['status'] == true) {
                    $_SESSION['alert'] = [
                        'title' => "Solicitud creada correctamente",
                        'success' => "Se ha creado la solicitud correctamente"
                    ];
                    header("Location: " . url("/requests"), true, 303);
                } else {
                    $_SESSION['alert'] = [
                        'title' => "No se pudo crear la solicitud",
                        'error' => "No se ha creado la solicitud correctamente"
                    ];
                    header("Location: " . url("/requests"));
                }
            } else {
                // Error al mover el archivo
                $_SESSION['alert'] = [
                    'title' => "Error al subir el archivo",
                    'error' => "Hubo un error al subir el archivo"
                ];
                header("Location: " . url("/requests"));
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }
}
