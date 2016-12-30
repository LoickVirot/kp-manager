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
        <h2>Matchs <small><a href=""><span class="glyphicon glyphicon-plus"></span>Ajouter un match</a></small></h2>
    </div>
</div>
