<?php

namespace App\controllers;

use App\models\entityManagers\DataManager;
use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerHome extends DefaultAbstractController
{
	private $dataManager;
	private $view;

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');
		else {
			$this->dataManager = new DataManager();
		}
		$data = $this->dataManager->getByIdUser($_SESSION['user']->getId());

		$this->view = new View('Home');
		$this->view->generate([
			'user' => $_SESSION['user'],
			'data' => $data
		]);
	}
}
