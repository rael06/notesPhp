<?php

namespace App\controllers;

use App\views\View;
use Exception;


class Router
{
	private $ctrl;
	private $view;

	public function routeReq()
	{
		try {
			$url = '';
//			if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) $this->ctrl = new ControllerLogin('Login');
//			else {
			if (isset($_GET['url'])) {
				$url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
				$controller = ucfirst(strtolower($url[0]));
				$controllerName = "Controller$controller";
				$controllerFile = "controllers/$controllerName.php";
				$controllerClass = "App\controllers\\$controllerName";

				if (file_exists($controllerFile)) $this->ctrl = new $controllerClass($url);
				else throw new Exception('Page introuvable');
			} else $this->ctrl = new ControllerHome($url);
//			}
		} catch (Exception $e) {
			$errorMsg = $e->getMessage();
			$this->view = new View('Error');
			$this->view->generate(['errorMsg' => $errorMsg]);
		}
	}
}
