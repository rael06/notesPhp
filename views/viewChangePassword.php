<?php /** @noinspection PhpUndefinedVariableInspection */ ?>
<section class="changePassword">
	<h3>Changement de mot de passe</h3>
	<?= isset($errors['badCredentials']) ? "<p class='text-danger'>Mauvais identifiants ! </p>" : null ?>
	<form action="" method="post">
		<?= isset($errors['emptyLogin']) ? "<p class='text-danger'>Veuillez remplir ce champ ! </p>" : null ?>
        <label>
            <span>Login</span>
            <input type="text" name="login" placeholder="Login" value="<?= isset($_POST['login']) ? $_POST['login'] : '' ?>">
        </label>
		<?= isset($errors['emptyPassword']) ? "<p class='text-danger'>Veuillez remplir ce champ ! </p>" : null ?>
        <label>
            <span>Mot de passe actuel</span>
            <input type="password" name="password" placeholder="Votre mot de passe" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
        </label>
		<?= isset($errors['emptyNewPassword']) ? "<p class='text-danger'>Veuillez remplir ce champ ! </p>" : null ?>
		<?= isset($errors['notEnoughChars']) ? "<p class='text-danger'>Le mot de passe doit contenir au moins 6 caractères ! </p>" : null ?>
        <label>
            <span>Nouveau mot de passe (6 caractères minimum)</span>
            <input type="password" name="newPassword" placeholder="Nouveau mot de passe (au moins 6 caractères)" value="<?= isset($_POST['newPassword']) ? $_POST['newPassword'] : '' ?>">
        </label>
		<?= isset($errors['emptyNewPasswordConfirm']) ? "<p class='text-danger'>Veuillez remplir ce champ ! </p>" : null ?>
		<?= isset($errors['notEqualsPasswords']) ? "<p class='text-danger'>Les mots de passes ne correspondent pas ! </p>" : null ?>
        <label>
            <span>Confirmez le nouveau mot de passe</span>
            <input type="password" name="newPasswordConfirm" placeholder="Confirmez le nouveau mot de passe" value="<?= isset($_POST['newPasswordConfirm']) ? $_POST['newPasswordConfirm'] : '' ?>">
        </label>

        <input type="submit" class="btn btn-primary" value="Envoi" name="submit">
		<input type="submit" class="btn btn-warning" value="Annuler" name="cancel">
	</form>
</section>
