<?php


namespace App\controllers;


use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerLogin extends DefaultAbstractController
{
	private $userManager;
	private $view;

	public function __construct($url)
	{
		$this->checkDisconnection();
		if (isset($url) && is_array($url) && count($url) > 1) throw new Exception('Page introuvable');
		else $this->userManager = new UserManager();

		$errors = [];
		if (isset($_POST['password']) && isset($_POST['login'])) {
			if (empty($_POST['login'])) $errors['login'] = TRUE;
			if (empty($_POST['password'])) $errors['password'] = TRUE;


			if (count($errors) === 0) {
				$_SESSION['authenticated'] = $this->userManager->checkLogin($_POST['login'], $_POST['password']);
				if ($_SESSION['authenticated'] === TRUE) {
					header('Location:Home');
				}
			}
		}


		$this->view = new View('Login');
		$this->view->generate(['errors' => $errors]);
	}
}
