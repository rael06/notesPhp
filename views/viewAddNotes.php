<?php
/** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpUndefinedMethodInspection */
?>
<section class="addNotes">
    <h3 class="sectionTitle mb-5">Ajout de notes</h3>
    <h3>Choisissez une classe</h3>
    <section class="sectionSelection">
        <form action="" method="post" id="form"></form>
        <div>
            <label>
                <select form="form" name="section">
					<?php foreach ($classes as $c) : ?>
                        <option <?= isset($_POST['section']) && $_POST['section'] === $c->getId() ?
                                'selected' : null ?>
                                value="<?= $c->getId() ?>">
							<?= ucfirst($c->getSection()) ?>
                        </option>
					<?php endforeach; ?>
                </select>
            </label>
        </div>
        <input form="form" type="submit" name="sectionSelectionConfirm" class="btn btn-primary" value="Valider">
    </section>

	<?php if ($users || count($errors) !== 0) : ?>
        <section class="userNotesEdition">
            <h3>Nouvelle note <?= $section ? $section->getSection() : null ?></h3>
            <div class="notesForm">

				<?= isset($errors['emptySubject']) ? "<p class='error'>Veuillez remplir ce champ ! </p>" : null ?>
                <label>
                    <span>Matière</span>
                    <input form="form" type="text" name="subject" placeholder="Matière"
                           value="<?= isset($_POST['subject']) ? $_POST['subject'] : null ?>">
                </label>

				<?php for ($i = 0; $i < count($users); $i++) : ?>
                    <label>
                        <span><?= $users[$i]->getFirstname() ?> <?= $users[$i]->getLastname() ?></span>
                        <input form="form" type="text" name="notes[<?= $users[$i]->getId() ?>]"
                               value="<?= isset($_POST['notes'][$users[$i]->getId()]) ?
	                               $_POST['notes'][$users[$i]->getId()] : null ?>">
                    </label>
				<?php endfor; ?>

                <input form="form" type="submit" class="btn btn-primary" value="Envoi" name="submit">
                <input form="form" type="submit" class="btn btn-warning" value="Retour" name="cancel">
            </div>
        </section>
	<?php endif; ?>
	<?php if ($success) : ?>
        <p class="success">Notes enregistrées avec succès</p>
	<?php endif; ?>
</section>

