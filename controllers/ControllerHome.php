<?php

namespace App\controllers;

use App\models\entityManagers\UserManager;
use App\views\View;
use Exception;

class ControllerHome extends DefaultAbstractController
{
	private $userManager;
	private $view;

	public function __construct($url)
	{
		$this->checkDisconnection();
		if (isset($url) && is_array($url) && count($url) > 1) throw new Exception('Page introuvable');
		else $this->userManager = new UserManager();

		$users = $this->userManager->getAll();

		$this->view = new View('Home');
		$this->view->generate(['users' => $users]);
	}
}
