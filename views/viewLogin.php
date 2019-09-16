<?php /** @noinspection PhpUndefinedVariableInspection */ ?>
<section class="login">
	<h3>Identification</h3>
	<?= isset($errors['badCredentials']) ? "<p class='error'>Mauvais identifiants ! </p>" : null ?>
	<form action="" method="post">
		<?= isset($errors['login']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
        <label>
            <span>Login</span>
            <input type="text" name="login" placeholder="Login" value="<?= isset($_POST['login']) ? $_POST['login'] : '' ?>">
        </label>
		<?= isset($errors['password']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
        <label>
            <span>Mot de passe</span>
            <input type="password" name="password" placeholder="Votre mot de passe" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
        </label>

        <button type="submit" class="text-center btn btn-primary" value="Envoi" name="submit">Envoi</button>
	</form>
</section>
