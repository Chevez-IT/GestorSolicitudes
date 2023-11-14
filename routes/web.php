<?php
    use Core\Route;

    Route::get('/', function () {
        return view("index");
    });

    //Admins routes





    //Employes routes




    //Companies routes
    Route::get('/companies', 'CompanyController@index');
    Route::post('/company/create', 'CompanyController@createCompany');
    Route::post('/company/update/status', 'CompanyController@updateCompanyStatus');
    