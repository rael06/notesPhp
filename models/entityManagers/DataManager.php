<?php


namespace App\models\entityManagers;


use App\models\entities\Data;
use App\models\Model;
use PDO;

class DataManager extends Model
{

	public function getAll()
	{
		$query = "SELECT id, id_user, subject, result FROM data";
		$pdoStatement = $this->pdo->query($query);
		return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Data::class);
	}

	public function getByIdUser($idUser)
	{
		$query = "SELECT id, id_user, subject, result FROM data
				WHERE id_user = $idUser";
		$pdoStatement = $this->pdo->query($query);
		return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Data::class);
	}

	public function addNotes(array $notesData)
	{
		$query = "INSERT INTO data (id_user, subject, result) 
					VALUES ";
		$params = [];
		$i = 0;
		foreach ($notesData as $noteData) {
			if ($i === 0) $query .= "(?,?,?)";
			else $query .= ",(?,?,?)";
			foreach ($noteData as $key => $value) $params[] = $value;
			$i++;
		}

		$pdoStatement = $this->pdo->prepare($query);

		return $pdoStatement->execute($params);
	}

	public function updateNotes(array $notesData)
	{
		$errors = [];
		$query = "UPDATE data SET result = ? WHERE id = ?";
		$pdoStatement = $this->pdo->prepare($query);
		foreach ($notesData as $noteData) {
			$errors[] = $pdoStatement->execute([$noteData['result'], $noteData['id']]);
		}
		return $errors;
	}

	public function deleteNotes(array $notesToDelete)
	{
		$errors = [];
		$query = "DELETE FROM data WHERE id = ?";
		$pdoStatement = $this->pdo->prepare($query);
		foreach ($notesToDelete as $noteData) {
			$errors[] = $pdoStatement->execute([$noteData['id']]);
		}
		return $errors;
	}
}
