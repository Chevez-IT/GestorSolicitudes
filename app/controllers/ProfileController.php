<?php

use Core\Database;
use Model\Account;
use Model\User;
use Model\Role;
use Model\Company;
use Core\Tools;

class ProfileController
{
    private $tools;
    private $accountModel;
    private $userModel;
    private $roleModel;
    private $companyModel;


    const ERROR_VIEW = 'error.404';
    const INDEX_VIEW = 'dashboard.profile';
    const PASSWORD_NEW_VIEW = 'dashboard.new-password';
    const PAGE_TITLE = "FGK - MKT & COM";

    public function __construct()
    {
        session_start();
        $db = new Database();
        $db->connect();
        $this->accountModel = new Account($db->getConnection());
        $this->userModel = new User($db->getConnection());
        $this->companyModel = new Company($db->getConnection());
        $this->roleModel = new Role($db->getConnection());
        $this->tools = new Tools();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $account = $this->accountModel->selectAccountByID('BC586'); //$_SESSION['user']['id']
            $user = $this->userModel->selectUserByAccountID('BC586'); //$accountInfo['account_id']
            $companies = $this->companyModel->getCompanies();
            $roles = $this->roleModel->getRoles();
            return view(self::INDEX_VIEW, ["pageTitle" => self::PAGE_TITLE, "account" => $account, "user" => $user, "companies" => $companies, "roles" => $roles]);
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function passwordNew()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $account = $this->accountModel->selectAccountByID('BC586');
            $user = $this->userModel->selectUserByAccountID('BC586');
            return view(self::PASSWORD_NEW_VIEW, ["pageTitle" => self::PAGE_TITLE, "account" => $account, "user" => $user]);
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $account_id = $this->tools->sanitize($_POST['account_id']);
            $user_id = $this->tools->sanitize($_POST['user_id']);
            $status = "Inactivo";
            $responseA = $this->accountModel->updateAccountStatus($account_id, $status);
            $responseU = $this->userModel->updateUserStatus($user_id, $status);

            $responseA_data = json_decode($responseA, true);
            $responseU_data = json_decode($responseU, true);

            if ($responseA_data['status'] == true) {
                if ($responseU_data['status'] == true) {
                    $_SESSION['alert']  = [
                        'success' => "Cuenta desactiva exitosamente"
                    ];
                    header("Location: " . url("/"), true, 303);
                } else {
                    // Manejar el error, posiblemente redirigir a una página de error
                    return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
                }
            } else {
                // Manejar el error, posiblemente redirigir a una página de error
                return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }


    public function updatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $account_id = $this->tools->sanitize($_POST['account_id']);
            $account_password = $_POST['account_password'];
            $new_account_password = $_POST['new_account_password'];
            $confirm_new_account_password = $_POST['confirm_new_account_password'];

            $account_password_bd = $this->accountModel->selectAccountPasswordByID('BC586');

            if (password_verify($account_password, $account_password_bd['account_password'],)) {
                if ($new_account_password === $confirm_new_account_password) {
                    $new_account_password_encryp = password_hash($new_account_password, PASSWORD_DEFAULT);
                    $response = $this->accountModel->updateAccountPassword($account_id, $new_account_password_encryp);

                    $response_data = json_decode($response, true);
                    if ($response_data['status'] == true) {
                        $_SESSION['alert']  = [
                            'success' => "Contraseña Actualizada"
                        ];
                        header("Location: " . url("/profile"), true, 303);
                    } else {
                        $_SESSION['alert']  = [
                            'error' => "No se ha podido actualizar la contraseña, intentalo otra vez"
                        ];
                        header("Location: " . url("/profile/password/new"), true, 303);
                    }
                } else {
                    $_SESSION['alert']  = [
                        'error' => "ha habido un error verifica que las contraseñas nuevas sean iguales"
                    ];
                    header("Location: " . url("/profile/password/new"), true, 303);
                }
            } else {
                $_SESSION['alert']  = [
                    'error' => "ha habido un error verifica que la contraseña actual sea la correcta"
                ];
                header("Location: " . url("/profile/password/new"), true, 303);
            }
        }
    }

    public function updateAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $account_id = $this->tools->sanitize($_POST['account_id']);
            $account_name = $this->tools->sanitize($_POST['account_name']);
            $account_email = $this->tools->sanitize($_POST['account_email']);
            $account_role = $this->tools->sanitize($_POST['role_id']);
            $response = $this->accountModel->updateAccount($account_id, $account_name, $account_email, $account_role);
            $response_data = json_decode($response, true);

            if ($response_data['status'] == true) {
                $_SESSION['alert']  = [
                    'title' => "Actualizado Correctamente",
                    'success' => "Se ha actualizado la informacion correctamente"
                ];
                header("Location: " . url("/profile"), true, 303);
            } else {
                $_SESSION['alert']  = [
                    'title' => "No se ha actualizado",
                    'error' => "Ha ocurrido un error, no se ha podido actualizado"
                ];
                header("Location: " . url("/profile"), true, 303);
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $this->tools->sanitize($_POST['user_id']);
            $user_names = $this->tools->sanitize($_POST['user_names']);
            $user_surnames = $this->tools->sanitize($_POST['user_surnames']);
            $user_phone = $this->tools->sanitize($_POST['user_phone']);
            $user_address = $this->tools->sanitize($_POST['user_address']);
            $company_id = $this->tools->sanitize($_POST['company_id']);
            $user_position = $this->tools->sanitize($_POST['user_position']);
            $user_area = $this->tools->sanitize($_POST['user_area']);

            $fieldsToValidate = [
                'user_id' => $user_id,
                'user_names' => $user_names,
                'user_surnames' => $user_surnames,
                'user_phone' => $user_phone,
                'user_address' => $user_address,
                'company_id' => $company_id,
                'user_position' => $user_position,
                'user_area' => $user_area
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
                    'title' => 'Actualizado correctamente',
                    'success' => "Usuario actualizado exitosamente"
                ];
                header("Location: " . url("/profile"), true, 303);
            } else {
                $_SESSION['alert']  = [
                    'title' => 'No se ha actualizado',
                    'error' => "Ha ocurrido un error, no se ha podido actualizar"
                ];
                header("Location: " . url("/profile"), true, 303);
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }
}
