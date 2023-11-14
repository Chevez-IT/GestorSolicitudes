<?php

use Core\Database;
use Model\Role;
use Core\Tools;

class RoleController
{

    private $tools;
    private $roleModel;

    const ERROR_VIEW = 'error.404';
    const INDEX_VIEW = 'role.index';
    const PAGE_TITLE = "FGK - MKT & COM";

    public function __construct()
    {
        $db = new Database();
        $db->connect();
        $this->roleModel = new Role($db->getConnection());
        $this->tools = new Tools();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $roles = $this->roleModel->getRoles();

            return view(self::INDEX_VIEW, ["pageTitle" => self::PAGE_TITLE, "roles" => $roles]);
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function createRole()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $role_name = $this->tools->sanitize($_POST['role-name']);
            $fieldsToValidate = [
                'role-name' => $role_name,
            ];


            $errors = $this->tools->validateFields($fieldsToValidate);

            if (!empty($errors)) {
                $data = $fieldsToValidate;
                $data['error'] = [];
                foreach ($errors as $field => $error) {
                    $data['error'][$field] = ['message' => $error];
                }
                $data['pageTitle'] = self::PAGE_TITLE;
                return view(self::INDEX_VIEW, $data);
            }
            $role_status = "Activo";


            $initials = strtoupper(substr($role_name, 0, 2));
            $numeroAleatorio = rand(100, 999);
            $role_id = $initials . $numeroAleatorio;


            $response = $this->roleModel->createRole($role_id, $role_name, $role_status, 1);

            $response_user = json_decode($response, true);

            if ($response_user['status'] == true) {
                $_POST = array();
                $_SESSION['success'] = "Rol agregado exitosamente";
                header("Location: " . url("/roles"), true, 303);
            }
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function updateRoleStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $role_id = $this->tools->sanitize($_POST['role-id']);
            $role_status = $this->tools->sanitize($_POST['role-status']);

            $response = $this->roleModel->updateRoleStatus($role_id, $role_status);

            $response_data = json_decode($response, true);

            if ($response_data['status'] == true) {
                $_SESSION['success'] = "Estado del rol actualizado exitosamente";
                header("Location: " . url("/roles"), true, 303);
            } else {
                // Manejar el error, posiblemente redirigir a una página de error
                return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }
}
