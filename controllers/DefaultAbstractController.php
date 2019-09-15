<?php


namespace App\controllers;


class DefaultAbstractController
{
	protected $view;

	protected function redirect()
	{
		if ($_SESSION['user']->getRole() === '0') header('Location:home');
		if ($_SESSION['user']->getRole() === '1') header('Location:admin');
	}
}
