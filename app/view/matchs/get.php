<h1>
    Matchs
    <small>
        <a href="/matchs/edit/<?= $data['match']['id_match'] ?>">
            <span class="glyphicon glyphicon-pencil"></span> Modifier
        </a>
    </small>
</h1>
<a href='/matchs/get/<?= $data['id_match'] ?>' class="btn btn-default">Retour</a>
<div class="match-view">
    <?php $data['match']['lieu'] == "domicile" ? $class = 'match' : $class = 'match-reverse' ?>
    <div class="<?= $class ?>">
        <div class="team">
            <h3><?= $data['team'] ?></h3>
            <h3><?= $data['match']['score_team'] ?></h3>
        </div>
        <div class="between"></div>
        <div class="adv">
            <h3><?= $data['match']['score_adv'] ?></h3>
            <h3><?= $data['match']['adversaire'] ?></h3>
        </div>
    </div>
    <div class="divider"></div>
</div>
<div>
    <?php if ($data['isMatchFinished']) : ?>
        <b class="text-danger">Terminé</b>
        <p>Match du <b><?= date("d/m/Y", strtotime($data['match']['date'])) ?></b> à <b><?= $data['match']['lieu'] ?></b>.</p>
    <?php else : ?>
        Match le <b><?= date("d/m/Y", strtotime($data['match']['date'])) ?></b> à <b><?= $data['match']['lieu'] ?></b>.
    <?php endif; ?>
</div>
<h2>
    Joueurs sélectionnés
    <?php if (!$data['isMatchFinished']) : ?>
    <small>
        <a href="/matchs/selection/<?= $data['match']['id_match'] ?>">
            <span class="glyphicon glyphicon-th-list"></span> Modifier la sélection
        </a>
    </small>
    <?php endif; ?>
</h2>
<table class="table">
    <thead>
    <th>Numero de licence</th>
    <th>Prénom</th>
    <th>Nom</th>
    <th>Poste</th>
    <th>Status</th>
    <?php if (!$data['isMatchFinished']) : ?>
        <th>Action</th>
    <?php else: ?>
        <th>Note</th>
        <th>Noter</th>
    <?php endif; ?>
    </thead>
    <tbody>
    <?php foreach ($data['players'] as $player) : ?>
        <tr>
            <td><?= $player['numero_licence'] ?></td>
            <td><?= $player['prenom'] ?></td>
            <td><?= $player['nom'] ?></td>
            <td><?= $player['nom_poste'] ?></td>
            <td><?= ucfirst($player['status']) ?></td>
            <?php if (!$data['isMatchFinished']) : ?>
                <td><a href="/matchs/remove/<?= $data['match']['id_match'] ?>/<?= $player['numero_licence'] ?>" class="text-danger">Retirer</a></td>
            <?php else: ?>
                <td><?= $player['note'] ?>/5</td>
                <td>
                    <form action="/matchs/note/<?= $data['match']['id_match'] ?>/<?= $player['numero_licence'] ?>" method="post">
                        <div class="btn-group" role="group">
                            <input type="submit" class="btn btn-default" name="note" value="1">
                            <input type="submit" class="btn btn-default" name="note" value="2">
                            <input type="submit" class="btn btn-default" name="note" value="3">
                            <input type="submit" class="btn btn-default" name="note" value="4">
                            <input type="submit" class="btn btn-default" name="note" value="5">
                        </div>
                    </form>
                </td>
            <?php endif; ?>
            </tr>
    <?php endforeach; ?>
    </tbody>
</table>