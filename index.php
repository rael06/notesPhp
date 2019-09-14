<?php

use App\Autoloader;
use App\controllers\Router;
use App\models\entityManagers\UserManager;

require "core/Autoloader.php";
Autoloader::register();

$router = new Router();
$router->routeReq();

