<?php
namespace App\controllers;

use Exception;

class Router
{
	private $ctrl;
	private $view;

	public function routeReq() {
		try {
			$url = '';
			if (isset($_GET['url'])) {
				$url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
				$controller = ucfirst(strtolower($url[0]));
				$controllerClass = "Controllers$controller";
				$controllerFile = "controllers/$controllerClass.php";

				if (file_exists($controllerFile)) {
					require_once $controllerFile;
					$this->ctrl = new $controllerClass($url);
				}
				else {
					throw new Exception('Page introuvable');
				}
			}
			else {
				$this->ctrl = new ControllerHome($url);
			}
		} catch (Exception $e) {
			$errorMsg = $e->getMessage();
			require_once 'views/viewError.php';
		}
	}
}
