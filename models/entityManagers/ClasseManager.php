<?php


namespace App\models\entityManagers;

use App\models\entities\Classe;
use App\models\entities\User;
use App\models\Model;
use PDO;

class ClasseManager extends Model
{
	public function getAll()
	{
		$query = "SELECT id, section FROM classes";
		$pdoStatement = $this->pdo->query($query);
		return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Classe::class);
	}
}
