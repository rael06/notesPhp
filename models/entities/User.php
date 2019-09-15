<?php

namespace App\models\entities;

class User
{
	private $id;
	private $login;
	private $passwd;
	private $lastname;
	private $firstname;
	private $section;
	private $role;

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
	public function getLogin()
	{
		return $this->login;
	}

	/**
	 * @param mixed $login
	 */
	public function setLogin($login)
	{
		$this->login = $login;
	}

	/**
	 * @return mixed
	 */
	public function getPasswd()
	{
		return $this->passwd;
	}

	/**
	 * @param mixed $passwd
	 */
	public function setPasswd($passwd)
	{
		$this->passwd = $passwd;
	}

	/**
	 * @return mixed
	 */
	public function getLastname()
	{
		return $this->lastname;
	}

	/**
	 * @param mixed $lastname
	 */
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}

	/**
	 * @return mixed
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}

	/**
	 * @param mixed $firstname
	 */
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;
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

	/**
	 * @return mixed
	 */
	public function getRole()
	{
		return $this->role;
	}

	/**
	 * @param mixed $role
	 */
	public function setRole($role)
	{
		$this->role = $role;
	}


}
