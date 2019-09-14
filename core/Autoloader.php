<?php

namespace App;

class Autoloader
{
	static function register()
	{
		spl_autoload_register([__CLASS__, "autoload"]);
	}

	static function autoload($class)
	{
		$autoloaderDirFromRoot = 'core';
//			var_dump($class);
		if (strpos($class, __NAMESPACE__ . "\\") === 0) {
//			var_dump($class);
			$class = explode("\\", $class);
			$class = array_slice($class, 1);
			$class = implode("\\", $class);
//			var_dump($class);
			$classPath = str_replace("\\$autoloaderDirFromRoot", "\\", __DIR__) . $class . ".php";
//			var_dump($classPath);
			require_once $classPath;
		}
	}
}


