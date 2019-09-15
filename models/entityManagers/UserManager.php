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

	public function getAllStudents()
	{
		$query = "SELECT id, login, passwd, lastname, firstname, section, role 
					FROM users 
					WHERE role = 0";
		$pdoStatement = $this->pdo->query($query);
		return $pdoStatement->fetchAll(PDO::FETCH_CLASS, User::class);
	}

	public function getByLoginPassword($login, $password)
	{
		$password = sha1($password);
		$query = "SELECT id, login, lastname, firstname, section, role 
				FROM users WHERE login = ? AND passwd = ?";
		$pdoStatement = $this->pdo->prepare($query);
		$pdoStatement->execute([$login, $password]);
		return $pdoStatement->fetchObject(User::class);
	}

	public function updatePassword($id, $password)
	{
		$password = sha1($password);
		$query = "UPDATE users SET passwd = ? WHERE id = $id";
		$pdoStatement = $this->pdo->prepare($query);
		return $pdoStatement->execute([$password]);
	}

	public function getUsersDataByFilter($filterType = null, $value = null)
	{
		$query = "SELECT users.id, lastname, firstname, 
       				GROUP_CONCAT(subject SEPARATOR ',') AS subject, 
       				GROUP_CONCAT(result SEPARATOR ',') AS result
					FROM users
					INNER JOIN data
					ON data.id_user = users.id";

		if ($filterType && $value) $query .= " WHERE users.$filterType = $value";
		$query .= " GROUP BY users.id";
		$pdoStatement = $this->pdo->prepare($query);
		$pdoStatement->execute();
		return $pdoStatement->fetchAll(PDO::FETCH_OBJ);
	}
}

