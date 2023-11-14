<?php
    use Core\Route;

    Route::get('/', function () {
        return view("index");
    });

// vista al dashboard

Route::post('/user/auth', 'AuthenticateController@user_auth');