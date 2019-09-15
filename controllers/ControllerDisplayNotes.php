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

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else {
			$this->userManager = new UserManager();
			$this->classeManager = new ClasseManager();
		}

		$data = $this->userManager->getAllAndData();
		$classes = $this->classeManager->getAll();

		$this->view = new View('DisplayNotes');
		$this->view->generate([
			'user' => $_SESSION['user'],
			'data' => $data,
			'classes' => $classes
		]);
	}
}
