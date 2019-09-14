<?php


namespace App\models;


use Exception;
use PDO;

class DbConnection
{
	const USERNAME = "root";
	const PASSWORD = "";
	const HOST = "localhost";
	const DB_NAME = "projetnotesphp";

	public static $instance = null;

	private function __construct()
	{
		$dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME;
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
		);

		try {
			self::$instance = new PDO($dsn, self::USERNAME, self::PASSWORD, $options);
//			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		} catch (Exception $exception) {
			$exception->getMessage();
		}
	}

	public static function getInstance()
	{
		if (self::$instance === null) {
			new DbConnection();
			return self::$instance;
		} else {
			return self::$instance;
		}
	}
}
