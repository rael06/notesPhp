<?php


namespace App\views;


use mysql_xdevapi\Exception;

class View
{
	private $file;
	private $title;
	private $style;

	public function __construct($action)
	{
		$this->file = "views/view$action.php";
		$this->title = $action;
		$this->style = file_exists("public/css/" . strtolower($action) . ".css") ?
			"public/css/" . strtolower($action) . ".css" : '';
	}

	public function generate($data)
	{
		$content = $this->generateFile($this->file, $data);
		$view = $this->generateFile("views/defaultTemplate.php", [
			'style' => $this->style,
			'title' => $this->title,
			'content' => $content
		]);

		echo $view;
	}

	private function generateFile($file, array $data)
	{
		if (file_exists($file)) {
			extract($data);
			ob_start();
			require $file;
			return ob_get_clean();
		} else throw new Exception("Fichier $file introuvable");
	}
}
