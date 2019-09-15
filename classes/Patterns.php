<?php

namespace App\classes;

class Patterns
{
	public static $password = "#[A-Za-z\d]{6,}$#";
	public static $number = "#[0-9]#";
	public static $onlyLetters = "#[a-zA-Z]#";
}
