<?php
/** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpUndefinedMethodInspection */
?>
<section class="updateUser">
    <h3 class="sectionTitle mb-4">Edition d'utilisateur</h3>
    <section class="userSelection">
        <form action="" method="post" id="form"></form>
        <div>
            <label>Utilisateur
                <select form="form" name="user">
					<?php foreach ($users as $u) : ?>
                        <option <?= isset($_POST['user']) && $_POST['user'] === $u->getId() ? 'selected' : null ?>
                                value="<?= $u->getId() ?>">
							<?= ucfirst($u->getFirstname()) ?> <?= ucfirst($u->getLastname()) ?>
                        </option>
					<?php endforeach; ?>
                </select>
            </label>
        </div>
        <input form="form" type="submit" name="userSelectionConfirm" class="btn btn-primary" value="Valider">
    </section>

	<?php if (isset($user) || count($errors) !== 0) : ?>
        <section class="userEdition">
            <h3>Modification d'un utilisateur</h3>
            <div class="updateUserForm">
				<?= isset($errors['emptyLogin']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
                <label>
                    <span>Login</span>
                    <input form="form" type="text" name="login" placeholder="Login"
                           value="<?= isset($_POST['login']) ? $_POST['login'] : $user->getLogin() ?>">
                </label>


				<?= isset($errors['emptyFirstName']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
				<?= isset($errors['badFormatFirstName']) ? "<p class='error'>Le prénom ne doit contenir que des lettres ou tirets, sans espace ! </p>" : null ?>
                <label>
                    <span>Prénom</span>
                    <input form="form" type="text" name="firstName" placeholder="Prénom"
                           value="<?= isset($_POST['firstName']) ? $_POST['firstName'] : $user->getFirstname() ?>">
                </label>


				<?= isset($errors['emptyLastName']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
				<?= isset($errors['badFormatLastName']) ? "<p class='error'>Le nom ne doit contenir que des lettres ou tirets, sans espace ! </p>" : null ?>
                <label>
                    <span>Nom</span>
                    <input form="form" type="text" name="lastName" placeholder="Nom"
                           value="<?= isset($_POST['lastName']) ? $_POST['lastName'] : $user->getLastname() ?>">
                </label>


                <label>Section
                    <select form="form" name="section">
                        <option <?= isset($user) && $user->getSection() === '0' ? 'selected' : null ?> value="0">Sans
                        </option>
						<?php foreach ($classes as $c) : ?>
                            <option <?= isset($_POST['section']) && $_POST['section'] === $c->getId() ||
							isset($user) && $user->getSection() === $c->getId() ? 'selected' : null ?>
                                    value="<?= $c->getId() ?>"><?= $c->getSection() ?>
                            </option>
						<?php endforeach; ?>
                    </select>
                </label>

				<?= isset($errors['emptyRole']) ? "<p class='error'>Veuillez choisir une option ! </p>" : null ?>
                <div class="roleRadio">
                    <label>Etudiant
                        <input form="form" type="radio" name="role" value='0'
							<?= isset($_POST['role']) && $_POST['role'] === '0' || isset($user) && $user->getRole() === '0' ? 'checked' : null ?>>
                    </label>
                    <label>Admin
                        <input form="form" type="radio" name="role" value='1'
							<?= isset($_POST['role']) && $_POST['role'] === '1' || isset($user) && $user->getRole() === '1' ? 'checked' : null ?>>
                    </label>
                </div>

                <input form="form" type="hidden" name="userId" value="<?= $user->getId() ?>">

                <input form="form" type="submit" class="btn btn-primary" value="Envoi" name="submit">
                <input form="form" type="submit" class="btn btn-warning" value="Retour" name="cancel">
            </div>
        </section>
	<?php endif; ?>
	<?php if ($success) : ?>
        <p class="success">Modification enregistrée avec succès</p>
	<?php endif; ?>
</section>
