<?php


namespace App\controllers;


use App\classes\Patterns;
use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerChangePassword extends DefaultAbstractController
{
	private $userManager;
	private $errors = [];

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else
			$this->userManager = new UserManager();

		if (isset($_POST['cancel'])) $this->redirect();

		if (isset($_POST['submit'])) {
			$this->checkFormErrors();

			if (count($this->errors) === 0) {
				$foundUser =
					$this->userManager->getByLoginPassword($_POST['login'], $_POST['password']) ?
						TRUE : FALSE;
				if ($foundUser) {
					if ($this->saveChanges()) $this->redirect();
				} else {
					$this->errors['badCredentials'] = TRUE;
				}
			}
		}

		$this->view = new View('ChangePassword');
		$this->view->generate([
			'errors' => $this->errors
		]);
	}

	private function checkFormErrors()
	{
		if (empty($_POST['login']))
			$this->errors['emptyLogin'] = TRUE;
		if (empty($_POST['password']))
			$this->errors['emptyPassword'] = TRUE;
		if (empty($_POST['newPassword']))
			$this->errors['emptyNewPassword'] = TRUE;
		if (empty($_POST['newPasswordConfirm']))
			$this->errors['emptyNewPasswordConfirm'] = TRUE;
		if ($_POST['newPasswordConfirm'] != $_POST['newPassword'])
			$this->errors['notEqualsPasswords'] = TRUE;
		if (!preg_match(Patterns::$password, $_POST['newPassword']))
			$this->errors['notEnoughChars'] = TRUE;
	}

	private function saveChanges()
	{
		return $this->userManager->updatePassword($_SESSION['user']->getId(), $_POST['newPassword']);
	}
}
