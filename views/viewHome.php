<?php /** @noinspection PhpUndefinedVariableInspection */ ?>
<section>
	<p>
		<span><?= $user->getFirstname() ?> <?= $user->getLastname() ?></span>
		, vous êtes à présent connecté(e)
	</p>
	<p><a href="logout">Se déconnecter</a> | <a href="changePassword">Changer mot de passe</a></p>
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
