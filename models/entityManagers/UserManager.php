<?php

namespace App\models\entityManagers;

use App\classes\SecureData;
use App\models\entities\User;
use App\models\Model;
use PDO;

class UserManager extends Model
{
	public function getAll()
	{
		$query = "SELECT id, login, lastname, firstname, section, role FROM users";
		$pdoStatement = $this->pdo->query($query);
		return $pdoStatement->fetchAll(PDO::FETCH_CLASS, User::class);
	}

	public function getAllStudents()
	{
		$query = "SELECT id, login, lastname, firstname, section, role 
					FROM users 
					WHERE role = 0";
		$pdoStatement = $this->pdo->query($query);
		return $pdoStatement->fetchAll(PDO::FETCH_CLASS, User::class);
	}

	public function getById($id)
	{
		$query = "SELECT id, login, lastname, firstname, section, role 
				FROM users WHERE id = ?";
		$pdoStatement = $this->pdo->prepare($query);
		$pdoStatement->execute([$id]);
		return $pdoStatement->fetchObject(User::class);
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

	public function getBySection($section)
	{
		$query = "SELECT id, login, lastname, firstname, section, role 
					FROM users 
					WHERE section = ?";
		$pdoStatement = $this->pdo->prepare($query);
		$pdoStatement->execute([$section]);
		return $pdoStatement->fetchAll(PDO::FETCH_CLASS, User::class);
	}

	public function updatePassword($id, $password)
	{
		$password = sha1(SecureData::password($password));
		$query = "UPDATE users SET passwd = ? WHERE id = $id";
		$pdoStatement = $this->pdo->prepare($query);
		return $pdoStatement->execute([$password]);
	}

	public function getUsersDataByFilter($filterType = null, $value = null)
	{
		$filterType = SecureData::text($filterType);
		$query = "SELECT users.id, lastname, firstname, 
       				GROUP_CONCAT(subject SEPARATOR ',') AS subject, 
       				GROUP_CONCAT(result SEPARATOR ',') AS result
					FROM users
					INNER JOIN data
					ON data.id_user = users.id";

		if ($filterType && $value) $query .= " WHERE users.$filterType = ?";
		$query .= " GROUP BY users.id";
		$pdoStatement = $this->pdo->prepare($query);
		$pdoStatement->execute([$value]);
		return $pdoStatement->fetchAll(PDO::FETCH_OBJ);
	}

	public function add(array $userData)
	{
		$password = sha1(SecureData::password($userData['password']));
		$query = "INSERT INTO users (login, passwd, lastname, firstname, section, role) 
					VALUES (:login, :password, :lastName, :firstName, :section, :role)";

		$pdoStatement = $this->pdo->prepare($query);

		return $pdoStatement->execute([
			':login' => $userData['login'],
			':password' => $password,
			':lastName' => ucfirst($userData['lastName']),
			':firstName' => ucfirst($userData['firstName']),
			':section' => $userData['section'],
			':role' => $userData['role']
		]);
	}

	public function update(array $userData)
	{
		$query = "UPDATE users SET 
                 login = :login,
                 lastname = :lastName,
                 firstname = :firstName,
                 section = :section,
                 role = :role
                 WHERE id = :id";

		$pdoStatement = $this->pdo->prepare($query);

		return $pdoStatement->execute([
			':id' => $userData['id'],
			':login' => $userData['login'],
			':lastName' => ucfirst($userData['lastName']),
			':firstName' => ucfirst($userData['firstName']),
			':section' => $userData['section'],
			':role' => $userData['role']
		]);
	}
}

