<?php


namespace App\controllers;

use App\models\entityManagers\ClasseManager;
use App\models\entityManagers\DataManager;
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
	private $dataManager;

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else {
			$this->userManager = new UserManager();
			$this->classeManager = new ClasseManager();
			$this->dataManager = new DataManager();
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
				$this->success = $this->saveChanges();
				//reset $_POST on user edition success
				if ($this->success) $_POST = [];
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
		if (empty($_POST['subject']))
			$this->errors['emptySubject'] = TRUE;
	}

	private function saveChanges()
	{
		$notesData = [];
		foreach ($_POST['notes'] as $id_user => $note) {
			if (!empty($note) || $note === '0') {
				$noteData = [
					'id_user' => $id_user,
					'subject' => $_POST['subject'],
					'result' => $note
				];
				$notesData[] = $noteData;
			}
		}

		return $this->dataManager->addNotes($notesData);
	}
}
