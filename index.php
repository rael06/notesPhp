<?php

use App\Autoloader;
use App\controllers\Router;

define('URL', str_replace('index.php', '',
	(isset($_SERVER['HTTPS']) ? 'https' : 'http') .
	'://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));
require "core/Autoloader.php";
Autoloader::register();

session_start();
$router = new Router();
$router->routeReq();

