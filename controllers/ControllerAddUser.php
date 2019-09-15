<?php


namespace App\controllers;


use App\classes\Patterns;
use App\models\entityManagers\ClasseManager;
use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerAddUser extends DefaultAbstractController
{
	private $userManager;
	private $errors = [];
	private $classeManager;
	private $success;

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else {
			$this->userManager = new UserManager();
			$this->classeManager = new ClasseManager();

		}

		if (isset($_POST['cancel'])) $this->redirect();

		if (isset($_POST['submit'])) {
			$this->checkFormErrors();
			if (count($this->errors) === 0) $this->success = $this->saveChanges();
		}

		$classes = $this->classeManager->getAll();
		$this->view = new View('AddUser');
		$this->view->generate([
			'errors' => $this->errors,
			'classes' => $classes,
			'success' => $this->success
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

		if (empty($_POST['newPassword']))
			$this->errors['emptyNewPassword'] = TRUE;

		if (empty($_POST['newPasswordConfirm']))
			$this->errors['emptyNewPasswordConfirm'] = TRUE;

		if ($_POST['newPasswordConfirm'] != $_POST['newPassword'])
			$this->errors['notEqualsPasswords'] = TRUE;

		if (!preg_match(Patterns::$onlyLetters, $_POST['firstName']))
			$this->errors['badFormatFirstName'] = TRUE;

		if (!preg_match(Patterns::$onlyLetters, $_POST['lastName']))
			$this->errors['badFormatLastName'] = TRUE;
	}

	private function saveChanges()
	{
		$userData = [
			'login' =>	$_POST['login'],
			'password' => $_POST['newPassword'],
			'firstName' => $_POST['firstName'],
			'lastName' => $_POST['lastName'],
			'section' => $_POST['section'],
			'role' => $_POST['role']
		];
		return $this->userManager->add($userData);
	}
}
