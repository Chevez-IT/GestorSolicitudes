<?php
    use Core\Route;

    Route::get('/', function () {
        return view("index");
    });

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

    //User - Account routes
    Route::get('/users', 'UserController@index');
    Route::get('/accounts', 'AccountController@index');