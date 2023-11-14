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

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $companies = $this->companyModel->getCompanies();


            return view(self::INDEX_VIEW, ["pageTitle" => self::PAGE_TITLE, "companies" => $companies]);
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function createCompany()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $company_name = $this->tools->sanitize($_POST['company-name']);
            $fieldsToValidate = [
                'company-name' => $company_name,
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
            $company_status = "Activo";

            $existingCompany = $this->companyModel->selectCompanyByName($company_name);

            if (isset($existingCompany['status']) && $existingCompany['status'] === true) {
                $data = [
                    'pageTitle' => self::PAGE_TITLE,
                    'error' => [
                        'company-name' => ['message' => 'La empresa ya existe.'],
                    ],
                ];
                return view(self::INDEX_VIEW, $data);
            }
            do {
                $initials = strtoupper(substr($company_name, 0, 2));
                $numeroAleatorio = rand(100, 999);
                $company_id = $initials . $numeroAleatorio;
                $existingId = $this->companyModel->selectCompanyByID($company_id);
            } while ($existingId['status'] === true);

            $response = $this->companyModel->createCompany($company_id, $company_name, $company_status, 1);

            $response_user = json_decode($response, true);

            if ($response_user['status'] == true) {
                $_POST = array();
                $_SESSION['success'] = "Compañia agregada exitosamente";
                header("Location: " . url("/companies"), true, 303);
            }
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    public function updateCompanyStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $company_id = $this->tools->sanitize($_POST['company-id']);
            $company_status = $this->tools->sanitize($_POST['company-status']);

            $response = $this->companyModel->updateCompanyStatus($company_id, $company_status);

            $response_data = json_decode($response, true);

            if ($response_data['status'] == true) {
                $_SESSION['success'] = "Estado de la compañía actualizado exitosamente";
                header("Location: " . url("/companies"), true, 303);
            } else {
                // Manejar el error, posiblemente redirigir a una página de error
                return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
            }
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }
}
