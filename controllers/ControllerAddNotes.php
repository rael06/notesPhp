<?php


namespace App\controllers;


use App\classes\Patterns;
use App\models\entityManagers\ClasseManager;
use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerAddNotes extends DefaultAbstractController
{
	private $userManager;
	private $errors = [];
	private $classeManager;
	private $success;
	private $section;

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else {
			$this->userManager = new UserManager();
			$this->classeManager = new ClasseManager();
		}

		$classes = $this->classeManager->getAll();

		$this->section = isset($_POST['section']) ?
			$this->classeManager->getById($_POST['section']) : null;

		$users = (isset($_POST['section'])) ?
			$this->userManager->getBySection($_POST['section']) : [];

		//reset $_POST but not $_POST['section'] on section selection button pressed
		if (isset($_POST['sectionSelectionConfirm'])) {
			$postedSection = $_POST['section'];
			$_POST = [];
			$_POST['section'] = $postedSection;
		}

		if (isset($_POST['cancel'])) $this->redirect();

		if (isset($_POST['submit'])) {
			$this->checkFormErrors();
			if (count($this->errors) === 0) {
//				$this->success = $this->saveChanges();
				//reset $_POST on user edition success
				if ($this->success) $_POST=[];
			}
		}

		$this->view = new View('AddNotes');
		$this->view->generate([
			'errors' => $this->errors,
			'classes' => $classes,
			'users' => $users,
			'success' => $this->success,
			'section' => $this->section
		]);
	}

	private function checkFormErrors()
	{
		if (empty($_POST['noteType']))
			$this->errors['emptyNoteType'] = TRUE;

//		if (!preg_match(Patterns::$number, $_POST['note']))
//			$this->errors['badFormatNote'] = TRUE;
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
