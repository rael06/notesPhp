<?php


namespace App\controllers;

use App\views\View;
use Exception;

class ControllerAdmin extends DefaultAbstractController
{
	public function __construct($url)
	{
		if (isset($url) && is_array($url) && count($url) > 1)
			throw new Exception('Page introuvable');


		$this->view = new View('Admin');
		$this->view->generate([
			'user' => $_SESSION['user']
		]);
	}
}
