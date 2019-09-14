<?php

namespace App\models\entityManagers;

use App\models\entities\User;
use App\models\Model;
use PDO;

class UserManager extends Model
{

	public function getAll()
	{
		$query = "SELECT id, login, passwd, lastname, firstname, section, role FROM users";
		$pdoStatement = $this->pdo->query($query);
		return $pdoStatement->fetchAll(PDO::FETCH_CLASS, User::class);
	}

	public function checkLogin($login, $password) {
		$password = sha1($password);
		$query = "SELECT id FROM users WHERE login = ? AND passwd = ?";
		$pdoStatement = $this->pdo->prepare($query);
		$pdoStatement->execute([$login, $password]);
		return $pdoStatement->rowCount() > 0 ? TRUE : FALSE;
	}
}
