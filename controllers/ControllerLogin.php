<?php


namespace App\controllers;


use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerLogin extends DefaultAbstractController
{
	private $userManager;
	private $view;
	private $errors = [];

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else
			$this->userManager = new UserManager();

		$this->checkLoginPassword();

		$this->view = new View('Login');
		$this->view->generate(['errors' => $this->errors]);
	}

	private function checkLoginPassword () {
		if (isset($_POST['password']) && isset($_POST['login'])) {
			if (empty($_POST['login']))
				$this->errors['login'] = TRUE;
			if (empty($_POST['password']))
				$this->errors['password'] = TRUE;

			if (count($this->errors) === 0) {
				$_SESSION['user'] =
					$this->userManager->getByLoginPassword($_POST['login'], $_POST['password']);

				$_SESSION['authenticated'] = $_SESSION['user'] ? TRUE : FALSE;

				if ($_SESSION['authenticated'])
					header('Location:home');
				else
					$this->errors['badCredentials'] = TRUE;
			}
		}
	}
}
