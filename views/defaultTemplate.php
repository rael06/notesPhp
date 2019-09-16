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
		<?php if ($style) : ?>
			<link rel="stylesheet" href="<?= $style ?>">
		<?php endif ?>
		<title><?= $title ?></title>
	</head>
	<body>
        <header>
	        <?php if (isset($user) && isset($_GET['url']) && $_GET['url'] !== 'login') : ?>
                <section>
                    <p>
                        <span><?= $user->getFirstname() ?> <?= $user->getLastname() ?></span>
                        , vous êtes à présent connecté(e)
                    </p>
                    <div>
                        <a href="logout">Se déconnecter</a>
                        |
                        <a href="changePassword">Changer mot de passe</a>
                        <?php if ($user->getRole() === '1') : ?>
                        |
                        <a href="addUser">Ajout utilisateur</a>
                        |
                        <a href="updateUser">Modification utilisateur</a>
                        |
                        <a href="displayNotes">Voir notes</a>
                        |
                        <a href="addNotes">Ajout notes</a>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>
        </header>
		<?= $content ?>
	</body>
</html>
