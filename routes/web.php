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
