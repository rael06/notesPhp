<?php

namespace App\controllers;

use App\models\entities\User;
use App\models\entityManagers\UserManager;
use mysql_xdevapi\Exception;

class ControllerHome
{
	private $userManager;
	private $view;

	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1) throw new Exception('Page introuvable');
		else $this->userManager = new UserManager();
		$users = $this->userManager->getAll();
		require 'views/viewHome.php';
	}
}
