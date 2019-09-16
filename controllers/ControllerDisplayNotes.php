<?php


namespace App\controllers;


use App\models\entityManagers\ClasseManager;
use App\models\entityManagers\DataManager;
use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerDisplayNotes extends DefaultAbstractController
{
	private $userManager;
	private $classeManager;
	private $dataManager;
	private $success;

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else {
			$this->userManager = new UserManager();
			$this->classeManager = new ClasseManager();
			$this->dataManager = new DataManager();
		}

		if (!isset($_SESSION['filterType']) && !isset($_SESSION['value']))
			$_SESSION['filterType'] = $_SESSION['value'] = null;

		if (isset($_POST['filterConfirm'])) {
			$_SESSION['filterType'] = isset($_POST['filterType']) ? $_POST['filterType'] : null;
			if ($_SESSION['filterType'] === 'id') $_SESSION['value'] = $_POST['user'];
			elseif ($_SESSION['filterType'] === 'section') $_SESSION['value'] = $_POST['section'];
		}

		$data = $this->userManager->getUsersDataByFilter($_SESSION['filterType'], $_SESSION['value']);

		$classes = $this->classeManager->getAll();
		$users = $this->userManager->getAllStudents();

		if (isset($_POST['updateButton'])) {
			$this->success = $this->saveChanges();
			$data = $this->userManager->getUsersDataByFilter($_SESSION['filterType'], $_SESSION['value']);
		}

		$this->view = new View('DisplayNotes');
		$this->view->generate([
			'user' => $_SESSION['user'],
			'data' => $data,
			'classes' => $classes,
			'users' => $users
		]);
	}

	private function saveChanges()
	{
		//$data is set to compare each result in data with posted result in order to not update all data table
		//but only for results changed
		$data = $this->dataManager->getAll();

		$notesData = [];
		foreach ($_POST['notes'] as $id => $note) {

			//comparison
			$match = FALSE;
			foreach ($data as $d) {
				if ($d->getId() == $id && $d->getResult() == $note) {
					$match = true;
					break;
				}
			}

			if ((!empty($note) || $note === '0') && !$match) {
				$noteData = [
					'id' => $id,
					'result' => $note
				];
				$notesData[] = $noteData;
			}
		}
		$updateErrors = $this->dataManager->updateNotes($notesData);
		return !in_array(FALSE, $updateErrors);
	}
}
