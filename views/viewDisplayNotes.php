<?php
/** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpUndefinedMethodInspection */
?>

<section class="displayNotes">
    <div>
        <h3>Filtres</h3>
        <div class="filters">
            <form action="" method="post">
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
            </form>
        </div>
    </div>

	<?php foreach ($data as $d) : ?>
        <div class="userNotes">
            <p><?= ucfirst($d->firstname) ?> <?= ucfirst($d->lastname) ?></p>
            <table>
                <tr>
					<?php foreach (explode(',', $d->subject) as $subject) : ?>
                        <td><?= $subject ?></td>
					<?php endforeach; ?>
                </tr>
                <tr>
					<?php foreach (explode(',', $d->result) as $result) : ?>
                        <td><input type="text" name="notes" value="<?= $result ?>"></td>
					<?php endforeach; ?>
                </tr>
            </table>
        </div>
	<?php endforeach; ?>
</section>

