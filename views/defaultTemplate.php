<?php /** @noinspection PhpUndefinedVariableInspection */ ?>
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
		      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="public/css/style.css">
		<?php if(!empty($style)) : ?>
			<link rel="stylesheet" href="<?= $style ?>">
		<?php endif ?>
		<title><?= $title ?></title>
	</head>
	<body>
		<header>
			<form action="">
				<input type="submit" value="clear session" name="destroy">
			</form>
		</header>
		<?= $content ?>
	</body>
</html>
