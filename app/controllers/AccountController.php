<?php

use Core\Database;
use Model\Account;
use Core\Tools;

class AccountController
{
    private $tools;
    private $accountModel;

    const ERROR_VIEW = 'error.404';
    const INDEX_VIEW = 'account.index';
    const PAGE_TITLE = "FGK - MKT & COM";

    public function __construct()
    {
        $db = new Database();
        $db->connect();
        $this->accountModel = new Account($db->getConnection());
        $this->tools = new Tools();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $accounts = $this->accountModel->getAccounts();
            return view(self::INDEX_VIEW, ["pageTitle" => self::PAGE_TITLE, "accounts" => $accounts]);
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }
}