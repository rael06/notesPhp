<?php
/** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpUndefinedMethodInspection */
?>
<section>
    <p>Voici vos notes :</p>
    <table>
        <tr>
            <th>Sujet</th>
            <th>Notes</th>
        </tr>
	    <?php foreach($data as $d) : ?>
        <tr>
            <td><?= $d->getSubject() ?></td>
            <td><?= $d->getResult() ?></td>
        </tr>
	    <?php endforeach; ?>
    </table>
</section>
