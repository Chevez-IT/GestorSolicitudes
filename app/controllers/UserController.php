<?php

use Core\Database;
use Model\User;
use Model\Role;
use Model\Company;
use Model\Account;
use Core\Tools;


class UserController
{
    private $tools;
    private $accountModel;
    private $roleModel;
    private $companyModel;
    private $userModel;


    const ERROR_VIEW = 'error.404';
    const INDEX_VIEW = 'user.index';
    const PAGE_TITLE = "FGK - MKT & COM";

    public function __construct()
    {
        session_start();
        $db = new Database();
        $db->connect();
        $this->accountModel = new Account($db->getConnection());
        $this->roleModel = new Role($db->getConnection());
        $this->companyModel = new Company($db->getConnection());
        $this->userModel = new User($db->getConnection());
        $this->tools = new Tools();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $users = $this->userModel->getUsers();
            $roles = $this->roleModel->getRoles();
            $companies = $this->companyModel->getCompanies();
            return view(self::INDEX_VIEW, ["pageTitle" => self::PAGE_TITLE, "users" => $users, "roles" => $roles, "companies" => $companies]);
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }


    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $user_names = $this->tools->sanitize($_POST['user_names']);
            $user_surnames = $this->tools->sanitize($_POST['user_surnames']);
            $account_email = $this->tools->sanitize($_POST['account_email']);
            $user_phone = $this->tools->sanitize($_POST['user_phone']);
            $user_address = $this->tools->sanitize($_POST['user_address']);
            $company_id = $this->tools->sanitize($_POST['company_id']);
            $user_position = $this->tools->sanitize($_POST['user_position']);
            $user_area = $this->tools->sanitize($_POST['user_area']);
            $role_id = $this->tools->sanitize($_POST['role_id']);

            $fieldsToValidate = [
                'user_names' => $user_names,
                'user_surnames' => $user_surnames,
                'account_email' => $account_email,
                'user_phone' => $user_phone,
                'user_address' => $user_address,
                'company_id' => $company_id,
                'user_position' => $user_position,
                'user_area' => $user_area,
                'role_id' => $role_id
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

            $initial_user_names = strtoupper(substr($user_names, 0, 1));
            $initial_user_surnames = strtoupper(substr($user_surnames, 0, 1));
            $random_number = rand(100, 999);
            $first_word_user_names = strtok($user_names, " ");
            $first_word_user_surnames = strtok($user_surnames, " ");
            $account_id = $initial_user_names . $initial_user_surnames . $random_number;
            $account_name = $first_word_user_names . $first_word_user_surnames . $random_number;
            $user_id = $account_id . $initial_user_names . $initial_user_surnames;
            $longPasswd = rand(8, 12);
            $password = $this->passwordRandom($longPasswd);
            $passwordEncryp = password_hash($password, PASSWORD_DEFAULT);
            $account_status = "Activo";
            $user_status = "Activo";

            $response_account = $this->accountModel->createAccount(
                $account_id,
                $account_name,
                $account_email,
                $passwordEncryp,
                $role_id,
                $account_status,
                1
            );

            $responseA = json_decode($response_account, true);

            if ($responseA['status'] == true) {
                $response_user = $this->userModel->createUser(
                    $user_id,
                    $account_id,
                    $user_names,
                    $user_surnames,
                    $user_address,
                    $user_phone,
                    $company_id,
                    $user_position,
                    $user_area,
                    $user_status,
                    1
                );

                $responseU = json_decode($response_user, true);
                if ($responseU['status'] == true) {
                    $mail_content = $this->buildMailContent($user_names." ".$user_surnames, $account_name, $account_email, $password);
                    $sendCredentials = $this->tools->sendEmail("Credenciales - FGK", $account_email, $mail_content);
                    $_POST = array();
                    $_SESSION['alert']  = [
                        'success' => "Cuenta creada exitosamente"
                    ];
                    header("Location: " . url("/users"), true, 303);
                }
            }
        }
    }

    public function updateUserStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $this->tools->sanitize($_POST['user_id']);
            $user_status = $this->tools->sanitize($_POST['user_status']);
            $response = $this->userModel->updateUserStatus($user_id, $user_status);

            $response_data = json_decode($response, true);

            if ($response_data['status'] == true) {
                $_SESSION['alert']  = [
                    'success' => "Estado del usuario actualizado exitosamente"
                ];
                header("Location: " . url("/users"), true, 303);
            } else {
                return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $this->tools->sanitize($_POST['new_user_id']);
            $user_names = $this->tools->sanitize($_POST['new_user_names']);
            $user_surnames = $this->tools->sanitize($_POST['new_user_surnames']);
            $user_phone = $this->tools->sanitize($_POST['new_user_phone']);
            $user_address = $this->tools->sanitize($_POST['new_user_address']);
            $company_id = $this->tools->sanitize($_POST['new_company_id']);
            $user_position = $this->tools->sanitize($_POST['new_user_position']);
            $user_area = $this->tools->sanitize($_POST['new_user_area']);

            $fieldsToValidate = [
                'new_user_id' => $user_id,
                'new_user_names' => $user_names,
                'new_user_surnames' => $user_surnames,
                'new_user_phone' => $user_phone,
                'new_user_address' => $user_address,
                'new_company_id' => $company_id,
                'new_user_position' => $user_position,
                'new_user_area' => $user_area
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

            $response = $this->userModel->updateUser($user_id, $user_names, $user_surnames, $user_address, $user_phone, $company_id, $user_position, $user_area);
            $response_data = json_decode($response, true);

            if ($response_data['status'] == true) {
                    $_POST = array();
                    $_SESSION['alert']  = [
                        'success' => "Usuario actualizado exitosamente"
                    ];
                    header("Location: " . url("/users"), true, 303);
            } else {
                // Manejar el error, posiblemente redirigir a una página de error
                return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }













    //Funciones adicionales
    function buildMailContent($user_fullname, $user_name, $user_email, $user_password) 
    {
        $mail_content = "
            <html>
            <head>
                <title>Bienvenido al gestor de solicitudes de FGK</title>
            </head>
            <body>
                <p>Hola $user_fullname,</p>
                <p>Te damos la bienvenida a nuestro sistema. A continuación, encontrarás la información de tu cuenta:</p>
                <ul>
                    <li><strong>Usuario:</strong> $user_name</li>
                    <li><strong>Correo:</strong> $user_email</li>
                    <li><strong>Contraseña:</strong> $user_password</li>
                </ul>
                <p>Por razones de seguridad, te recomendamos cambiar tu contraseña una vez que inicies sesión por primera vez.</p>
                <p>¡Gracias por unirte a nosotros!</p>
            </body>
            </html>
        ";
    
        return $mail_content;
    }

    public function passwordRandom($longitud)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_';

        $cadenaAleatoria = '';
        $maxCaracteres = strlen($caracteres) - 1;

        for ($i = 0; $i < $longitud; $i++) {
            $indiceAleatorio = rand(0, $maxCaracteres);
            $cadenaAleatoria .= $caracteres[$indiceAleatorio];
        }

        return $cadenaAleatoria;
    }
}
