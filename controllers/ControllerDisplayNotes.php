<?php


namespace App\controllers;


use App\models\entityManagers\ClasseManager;
use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerDisplayNotes extends DefaultAbstractController
{
	private $userManager;
	private $classeManager;

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else {
			$this->userManager = new UserManager();
			$this->classeManager = new ClasseManager();
		}
		$filterType = $value = null;
		if (isset($_POST['filterConfirm'])) {
			$filterType = isset($_POST['filterType']) ? $_POST['filterType'] : null;
			if ($filterType === 'id') $value = $_POST['user'];
			if ($filterType === 'section') $value = $_POST['section'];
		}

		$data = $this->userManager->getUsersDataByFilter($filterType, $value);
		$classes = $this->classeManager->getAll();
		$users = $this->userManager->getAllStudents();

		$this->view = new View('DisplayNotes');
		$this->view->generate([
			'user' => $_SESSION['user'],
			'data' => $data,
			'classes' => $classes,
			'users' => $users
		]);
	}
}
