<h1>
    Matchs
    <small>
        <a href="/matchs/edit/<?= $data['match']['id_match'] ?>">
            <span class="glyphicon glyphicon-pencil"></span> Modifier
        </a>
    </small>
</h1>
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
    Match le <b><?= date("d/m/Y", strtotime($data['match']['date'])) ?></b> à <b><?= $data['match']['lieu'] ?></b>.
</div>
<h2>
    Joueurs sélectionnés
    <small>
        <a href="/matchs/selection/<?= $data['match']['id_match'] ?>">
            <span class="glyphicon glyphicon-th-list"></span> Modifier la sélection
        </a>
    </small>
</h2>
<table class="table">
    <thead>
    <th>Numero de licence</th>
    <th>Prénom</th>
    <th>Nom</th>
    <th>Poste</th>
    </thead>
    <tbody>
    <?php foreach ($data['players'] as $player) : ?>
        <tr>
            <td><?= $player['numero_licence'] ?></td>
            <td><?= $player['prenom'] ?></td>
            <td><?= $player['nom'] ?></td>
            <td><?= $player['id_poste'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>