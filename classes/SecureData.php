<?php

namespace App\classes;

use function addslashes;
use function htmlentities;
use function trim;

class SecureData
{
	public static function text($field)
	{
		$field = trim($field);
		$field = addslashes($field);
		$field = htmlentities($field);
		$field = strip_tags($field);
		return $field;
	}

	public static function password($field)
	{
		$field = trim($field);
		return $field;
	}
}
