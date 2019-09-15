<?php


namespace App\controllers;


use App\classes\Patterns;
use App\models\entityManagers\ClasseManager;
use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerUpdateUser extends DefaultAbstractController
{
	private $userManager;
	private $errors = [];
	private $classeManager;
	private $success;
	private $user;

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else {
			$this->userManager = new UserManager();
			$this->classeManager = new ClasseManager();
		}

		$this->user = isset($_POST['userSelectionConfirm']) ? $this->userManager->getById($_POST['user']) : null;

		if (isset($_POST['cancel'])) $this->redirect();

		if (isset($_POST['submit'])) {
			$this->checkFormErrors();
			if (count($this->errors) === 0) {
				$this->success = $this->saveChanges();
				//reset $_POST on user edition success
				if ($this->success) $_POST=[];
			}
		}

		$users = $this->userManager->getAll();
		$classes = $this->classeManager->getAll();

		//reset $_POST but not $_POST['user'] on user selection button pressed
		if (isset($_POST['userSelectionConfirm'])) {
			$postedUser = $_POST['user'];
			$_POST = [];
			$_POST['user'] = $postedUser;
		}

		$this->view = new View('UpdateUser');
		$this->view->generate([
			'errors' => $this->errors,
			'classes' => $classes,
			'users' => $users,
			'success' => $this->success,
			'user' => $this->user
		]);
	}

	private function checkFormErrors()
	{
		if (empty($_POST['login']))
			$this->errors['emptyLogin'] = TRUE;

		if (empty($_POST['firstName']))
			$this->errors['emptyFirstName'] = TRUE;

		if (empty($_POST['lastName']))
			$this->errors['emptyLastName'] = TRUE;

		if (!isset($_POST['role']))
			$this->errors['emptyRole'] = TRUE;

		if (!preg_match(Patterns::$onlyLetters, $_POST['firstName']))
			$this->errors['badFormatFirstName'] = TRUE;

		if (!preg_match(Patterns::$onlyLetters, $_POST['lastName']))
			$this->errors['badFormatLastName'] = TRUE;
	}

	private function saveChanges()
	{
		$userData = [
			'id' => $_POST['userId'],
			'login' => $_POST['login'],
			'firstName' => $_POST['firstName'],
			'lastName' => $_POST['lastName'],
			'section' => $_POST['section'],
			'role' => $_POST['role']
		];
		return $this->userManager->update($userData);
	}
}
