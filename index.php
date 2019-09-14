<?php

use App\Autoloader;
use App\controllers\Router;

define('URL', str_replace('index.php', '',
	(isset($_SERVER['HTTPS']) ? 'https' : 'http') .
	'://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));
session_start();
require "core/Autoloader.php";
Autoloader::register();

$router = new Router();
$router->routeReq();

