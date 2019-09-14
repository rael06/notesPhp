<?php /** @noinspection PhpUndefinedVariableInspection */ ?>
<section>
	<h3>Identification</h3>
	<form action="" method="post">
		<?= isset($errors['login']) ? "<p class='text-danger'>Veuillez remplir ce champ ! </p>" : null ?>
		<input type="text" name="login" placeholder="Login" value="<?= isset($_POST['login']) ? $_POST['login'] : '' ?>">
		<?= isset($errors['password']) ? "<p class='text-danger'>Veuillez remplir ce champ ! </p>" : null ?>
		<input type="text" name="password" placeholder="Votre mot de passe" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
		<input type="submit" class="btn btn-primary" value="Envoi" name="submit">
	</form>
</section>
