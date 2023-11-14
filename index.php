<?php
include_once "./core/App.php";
include_once "./core/utils.php";
include_once "./core/Tools.php";
include_once "./core/Request.php";
require_once "./core/Route.php";
require_once "./core/Database.php";

use Core\Route;

include_once "./routes/web.php";
require_once "./core/Logic.php";



$request = new Request();
App::assets($request->getPublicUrl());
$url = $request->getUrl();
$routes = Route::getRoutes();

$request->validate($routes, $url);