<?php


namespace App\models\entities;


class Data
{
	private $id;
	private $id_user;
	private $subject;
	private $result;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getIdUser()
	{
		return $this->id_user;
	}

	/**
	 * @param mixed $id_user
	 */
	public function setIdUser($id_user)
	{
		$this->id_user = $id_user;
	}

	/**
	 * @return mixed
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * @param mixed $subject
	 */
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}

	/**
	 * @return mixed
	 */
	public function getResult()
	{
		return $this->result;
	}

	/**
	 * @param mixed $result
	 */
	public function setResult($result)
	{
		$this->result = $result;
	}


}
