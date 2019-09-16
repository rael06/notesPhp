<?php
/** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpUndefinedMethodInspection */
?>

<section class="displayNotes">
    <div>
        <h3>Filtres</h3>
        <div class="filters">
            <form action="" id="form" method="post">
                <label>
                    <select name="section">
						<?php foreach ($classes as $c) : ?>
                            <option <?= isset($_POST['section']) && $_POST['section'] === $c->getId() ? 'selected' : null ?>
                                    value="<?= $c->getId() ?>"><?= $c->getSection() ?>
                            </option>
						<?php endforeach; ?>
                    </select>
                </label>
                |
                <label>
                    <select name="user">
						<?php foreach ($users as $u) : ?>
                            <option <?= isset($_POST['user']) && $_POST['user'] === $u->getId() ? 'selected' : null ?>
                                    value="<?= $u->getId() ?>">
								<?= ucfirst($u->getFirstname()) ?> <?= ucfirst($u->getLastname()) ?>
                            </option>
						<?php endforeach; ?>
                    </select>
                </label>

                <label>Section
                    <input type="radio" name="filterType" value="section">
                </label>
                <label>Etudiant
                    <input type="radio" name="filterType" value="id">
                </label>

                <button type="submit" name="filterConfirm" class="btn btn-primary">Valider</button>
                <button type="submit" name="filterConfirm" class="btn btn-primary">Voir tout</button>
            </form>
        </div>
    </div>

    <input form="form" type="submit" value="Mettre à jour" name="updateButton" class="btn btn-primary">
    <input form="form" type="submit" value="Annuler" name="cancelUpdateButton" class="btn btn-warning">

	<?php foreach ($data as $d) : ?>
        <div class="usersNotes">
            <p><?= ucfirst($d->firstname) ?> <?= ucfirst($d->lastname) ?></p>
            <div class="userNotes">
				<?php for ($i = 0; $i < count(explode(',', $d->notes)); $i++) : ?>
                    <div class="userNote">
                        <p><?= explode(',', $d->subject)[$i] ?></p>
                        <input form="form" type="text" name="notes[<?= explode(',', $d->notes)[$i] ?>]" value="<?= explode(',', $d->result)[$i] ?>">
                    </div>
				<?php endfor; ?>
            </div>
        </div>
	<?php endforeach; ?>
</section>

