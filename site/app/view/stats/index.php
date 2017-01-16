<h1>Statistiques</h1>
<div class="stat-matchs">
    <h2>Matchs</h2>
    <div class="row">
        <div class="col-xs-4 col">
            <h3>Gagnés</h3>
            <h3><?= $data['matchs']['win'] ?></h3>
            <h4><?= round(($data['matchs']['win'] / $data['matchs']['total']) * 100) ?> %</h4>
        </div>
        <div class="col-xs-4 col">
            <h3>Nuls</h3>
            <h3><?= $data['matchs']['equal'] ?></h3>
            <h4><?= round(($data['matchs']['equal'] / $data['matchs']['total']) * 100) ?> %</h4>
        </div>
        <div class="col-xs-4 col">
            <h3>Perdus</h3>
            <h3><?= $data['matchs']['loose'] ?></h3>
            <h4><?= round(($data['matchs']['loose'] / $data['matchs']['total']) * 100) ?> %</h4>
        </div>
    </div>
</div>
<h2>Joueurs</h2>
<table class="table">
    <thead>
        <th>Joueur</th>
        <th>Statut</th>
        <th>Poste préféré</th>
        <th>Titulaire</th>
        <th>Remplaçant</th>
        <th>Note moyenne</th>
        <th>Matchs gagnés</th>
    </thead>
    <tbody>
        <?php foreach ($data['joueurs'] as $joueur) : ?>
            <tr>
                <td><?= $joueur['prenom'] ?> <?= $joueur['nom'] ?></td>
                <td><?= $joueur['statut'] ?></td>
                <td><?= $joueur['poste_pref'] ?></td>
                <td><?= $joueur['nb_titulaire'] ?></td>
                <td><?= $joueur['nb_remplacant'] ?></td>
                <td><?= round($joueur['moyenne'], 1)?>/5</td>
                <td><?= round(($joueur['nb_gagnes'] / $joueur['nb_match']) * 100, 2) ?> %</td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
