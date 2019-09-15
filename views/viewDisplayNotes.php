<?php /** @noinspection PhpUndefinedVariableInspection */ ?>

<?php
/** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpUndefinedMethodInspection */
?>

<section class="displayNotes">
    <div>
        <h3>Filtres</h3>
        <div class="filters">

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

