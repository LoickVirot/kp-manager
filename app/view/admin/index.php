<h1>Administration <small><a href="/auth/logout" class="text-danger">Déconnexion</a></small></h1>
<div class="row">
    <div class="col-md-6">
        <h2>Joueurs <small><a href="/joueurs/add"><span class="glyphicon glyphicon-plus"></span>Ajouter un joueur</a></small></h2>
        <table class="table players-list">
            <thead>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Photo</th>
            </thead>
            <tbody>
                <?php foreach($data['joueurs'] as $player) : ?>
                    <tr>
                        <td><?= $player['prenom'] ?></td>
                        <td><a href="/joueurs/get/<?= $player['numero_licence'] ?>"><?= $player['nom'] ?></a></td>
                        <td><img src="/<?= $player['photo'] ?>" alt="photo" class="player-photo"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/joueurs"><span class="glyphicon glyphicon-th-list"></span> Tous les joueurs</a>
    </div>
    <div class="col-md-6">
        <h2>Prochain Match <small><a href="/matchs"><span class="glyphicon glyphicon-th-list"></span> Tous les matchs</a></small></h2>
        <div class="panel panel-default">
            <div class="panel-heading">
                Date : <?= date("d/m/Y", strtotime($data['next_match']['date'])) ?>
                - <?= ucfirst($data['next_match']['lieu']) ?>
            </div>
            <div class="match-view-vs panel-body">
                <?php $data['next_match']['lieu'] == "domicile" ? $class = 'match' : $class = 'match-reverse' ?>
                <div class="<?= $class ?>">
                    <div class="team">
                        <h3><?= $data['team'] ?></h3>
                    </div>
                    <div class="between"><h3>VS</h3></div>
                    <div class="adv">
                        <h3><?= $data['next_match']['adversaire'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a href="/matchs/get/<?= $data['next_match']['id_match'] ?>">Voir le match</a>
            </div>
        </div>
    </div>
</div>
