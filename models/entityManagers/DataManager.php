<?php


namespace App\models\entityManagers;


use App\models\entities\Data;
use App\models\Model;
use PDO;

class DataManager extends Model
{
	public function getByIdUser($idUser) {
		$query = "SELECT id, id_user, subject, result FROM data
				WHERE id_user = $idUser";
		$pdoStatement = $this->pdo->query($query);
		return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Data::class);
	}
}
