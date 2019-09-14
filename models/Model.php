<?php

namespace App\models;

use PDO;

abstract class Model
{

	protected $pdo;

	public function __construct()
	{
		$this->pdo = DbConnection::getInstance();
	}
}

