<?php

use Core\Database;
use Model\Company;
use Core\Tools;

class CompanyController
{
    private $tools;
    private $companyModel;

    const ERROR_VIEW = 'error.404';
    const INDEX_VIEW = 'company.index';
    const PAGE_TITLE = "FGK - MKT & COM";

    public function __construct()
    {
        $db = new Database();
        $db->connect();
        $this->companyModel = new Company($db->getConnection());
        $this->tools = new Tools();
    }

    public function index(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view(self::INDEX_VIEW, ["pageTitle" => self::PAGE_TITLE]);
            exit();
        }else{
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function createCompany()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $company_name = $this->tools->sanitize($_POST['company-name']);
            $fieldsToValidate = [
                'company-namel' => $company_name,
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

            $initials = strtoupper(substr($company_name, 0, 2));
            $numeroAleatorio = rand(100, 999);
            $company_id = $initials . $numeroAleatorio;
            $company_status = "Activo";
            $response = $this->companyModel->createCompany($company_id, $company_name, $company_status ,1);

            $response_user = json_decode($response, true);

            if ($response_user['status'] == true) {
                $_POST = array();
                $_SESSION['success'] = "Compania agregada exitosamente";
                
                return view(self::INDEX_VIEW, ["pageTitle" => self::PAGE_TITLE]);
                exit();
            } else {
                unset($_SESSION['success']);
                return view(self::INDEX_VIEW, ["status" => $response_user['status'], "message" => $response_user['message'], "pageTitle" => self::PAGE_TITLE]);
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }
}
