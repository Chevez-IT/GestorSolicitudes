<?php

use Core\Database;
use Model\User;
use Core\Tools;
class UserController{
    private $tools;
    private $userModel;

    const ERROR_VIEW = 'error.404';
    const INDEX_VIEW = 'user.index';
    const PAGE_TITLE = "FGK - MKT & COM";

    public function __construct()
    {
        $db = new Database();
        $db->connect();
        $this->userModel = new User($db->getConnection());
        $this->tools = new Tools();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $users = $this->userModel->getUsers();


            return view(self::INDEX_VIEW, ["pageTitle" => self::PAGE_TITLE, "users" => $users]);
            exit();
        } else {
            return view(self::ERROR_VIEW, ["pageTitle" => self::PAGE_TITLE]);
        }
    }

    
    
}