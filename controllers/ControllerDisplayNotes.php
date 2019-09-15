<?php


namespace App\controllers;


use App\models\entityManagers\DataManager;
use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerDisplayNotes extends DefaultAbstractController
{
	private $userManager;

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else
			$this->userManager = new UserManager();

		$data = $this->userManager->getAllAndData();

		$this->view = new View('DisplayNotes');
		$this->view->generate([
			'user' => $_SESSION['user'],
			'data' => $data
		]);
	}
}
