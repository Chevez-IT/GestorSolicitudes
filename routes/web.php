<?php
    use Core\Route;

    Route::get('/', function () {
        return view("index");
    });
    Route::get("/profile", 'ProfileController@index');
    Route::get("/profile/password/new", 'ProfileController@passwordNew');
    Route::post("/profile/update/status", 'ProfileController@updateStatus');
    Route::post("/profile/update/password", 'ProfileController@updatePassword');
    Route::post("/profile/update/account", 'ProfileController@updateAccount');
    Route::post("/profile/update/user", 'ProfileController@updateUser');
    Route::get("/home", 'DashboardController@index');

  // vista al dashboard

    //Employes routes




    //Companies routes
    Route::get('/companies', 'CompanyController@index');
    Route::post('/company/create', 'CompanyController@createCompany');
    Route::post('/company/update/status', 'CompanyController@updateCompanyStatus');
    
    //Authenticate routes
    Route::post('/user/auth', 'AuthenticateController@user_auth');

    //Roles routes
    Route::get('/roles','RoleController@index');
    Route::post('/role/create','RoleController@createRole');
    Route::post('/role/update/status','RoleController@updateRoleStatus');
    Route::post('/role/update/permissions','RoleController@updateRolePermissions');

    //User routes
    Route::get('/users', 'UserController@index');
    Route::get('/users/create', 'UserController@createUser');
    Route::post('/users/update/status', 'UserController@updateUserStatus');
    Route::post('/users/update/user', 'UserController@updateUser');

    //Account routes
    Route::get('/accounts', 'AccountController@index');
    Route::get('/accounts/create', 'AccountController@createAccount');
    Route::post('/accounts/update/status', 'AccountController@updateAccountStatus');
    Route::post('/accounts/update/account', 'AccountController@updateAccount');
    