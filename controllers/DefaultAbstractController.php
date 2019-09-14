<?php


namespace App\controllers;


class DefaultAbstractController
{
	protected function checkDisconnection() {
		if (isset($_GET['destroy'])) $this->destroySession();
	}

	private function destroySession()
	{
		$_SESSION = array();
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		session_destroy();
		var_dump($_SESSION);
	}

	protected function clearPost()
	{
		$_POST = [];
	}
}
