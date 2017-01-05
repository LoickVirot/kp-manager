<h1>Sélection des joueurs</h1>
<?php if (isset($data['error'])) : ?>
    <div class="alert alert-danger">
        <?= $data['error'] ?>
    </div>
<?php endif; ?>
<form action="/matchs/selection/<?= $data['id_match'] ?>" method="post">
    <table class="table">
        <thead>
            <th>Selection</th>
            <th>Prénom</th>
            <th>Nom</th>
        </thead>
        <tbody>
            <?php foreach ($data['joueurs'] as $joueur) : ?>
                <tr>
                    <td>
                        <input type="checkbox" name="<?= $joueur['numero_licence'] ?>" value="<?= $joueur['numero_licence'] ?>">
                    </td>
                    <td><?= $joueur['prenom'] ?></td>
                    <td><?= $joueur['nom'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href='/matchs/edit/<?= $data['id_match'] ?>' class="btn btn-default">Annuler</a>
    <input type="submit" class="btn btn-primary" value="Valider">
</form>