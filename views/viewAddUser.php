<?php
/** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpUndefinedMethodInspection */
?>

<section class="addUser">
    <h3>Ajout d'un nouvel utilisateur</h3>
    <form action="" method="post">
		<?= isset($errors['emptyLogin']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
        <label>
            <span>Login</span>
            <input type="text" name="login" placeholder="Login"
                   value="<?= isset($_POST['login']) ? $_POST['login'] : '' ?>">
        </label>


		<?= isset($errors['emptyFirstName']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
		<?= isset($errors['badFormatFirstName']) ? "<p class='error'>Le prénom ne doit contenir que des lettres ou tirets, sans espace ! </p>" : null ?>
        <label>
            <span>Prénom</span>
            <input type="text" name="firstName" placeholder="Prénom"
                   value="<?= isset($_POST['firstName']) ? $_POST['firstName'] : '' ?>">
        </label>


		<?= isset($errors['emptyLastName']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
		<?= isset($errors['badFormatLastName']) ? "<p class='error'>Le nom ne doit contenir que des lettres ou tirets, sans espace ! </p>" : null ?>
        <label>
            <span>Nom</span>
            <input type="text" name="lastName" placeholder="Nom"
                   value="<?= isset($_POST['lastName']) ? $_POST['lastName'] : '' ?>">
        </label>


        <label>
            <select name="section">
				<?php foreach ($classes as $c) : ?>
                    <option <?= isset($_POST['section']) && $_POST['section'] === $c->getId() ? 'selected' : null ?>
                            value="<?= $c->getId() ?>"><?= $c->getSection() ?>
                    </option>
				<?php endforeach; ?>
            </select>
        </label>

		<?= isset($errors['emptyRole']) ? "<p class='error'>Veuillez choisir une option ! </p>" : null ?>
        <div class="roleRadio">
            <label>Etudiant
                <input type="radio" name="role" value='0'
					<?= isset($_POST['role']) && $_POST['role'] === '0' ? 'checked' : null ?>>
            </label>
            <label>Admin
                <input type="radio" name="role" value='1'
					<?= isset($_POST['role']) && $_POST['role'] === '1' ? 'checked' : null ?>>
            </label>
        </div>


		<?= isset($errors['emptyNewPassword']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
        <label>
            <span>Mot de passe</span>
            <input type="password" name="newPassword" placeholder="Mot de passe"
                   value="<?= isset($_POST['newPassword']) ? $_POST['newPassword'] : '' ?>">
        </label>


		<?= isset($errors['emptyNewPasswordConfirm']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
		<?= isset($errors['notEqualsPasswords']) ? "<p class='error'>Les mots de passes ne correspondent pas ! </p>" : null ?>
        <label>
            <span>Répétez le mot de passe</span>
            <input type="password" name="newPasswordConfirm" placeholder="Répétez le mot de passe"
                   value="<?= isset($_POST['newPasswordConfirm']) ? $_POST['newPasswordConfirm'] : '' ?>">
        </label>


        <input type="submit" class="btn btn-primary" value="Envoi" name="submit">
        <input type="submit" class="btn btn-warning" value="Retour" name="cancel">

		<?php if ($success) : ?>
            <p class="success">Enregistrement terminé avec succès</p>
		<?php endif; ?>
    </form>
</section>
