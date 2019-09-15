<?php


namespace App\models\entities;


class Classe
{
	private $id;
	private $section;

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
	public function getSection()
	{
		return $this->section;
	}

	/**
	 * @param mixed $section
	 */
	public function setSection($section)
	{
		$this->section = $section;
	}


}
