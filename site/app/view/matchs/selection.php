<h1>Sélection des joueurs</h1>
<a href='/matchs/get/<?= $data['id_match'] ?>' class="btn btn-default">Retour</a>
<?php if (isset($data['error'])) : ?>
    <div class="alert alert-danger">
        <?= $data['error'] ?>
    </div>
<?php endif; ?>
<?php if (empty($data['joueurs'])) : ?>
    <div class="alert alert-warning">
        Pas de joueurs disponibles. <b><a href="/matchs/get/<?= $data['id_match'] ?>" class="text-warning">Retour</a></b>
    </div>
<?php else : ?>
    <div class="players">
        <?php foreach ($data['joueurs'] as $joueur) : ?>
            <div class="panel panel-default player-card">
                <div class="photo">
                    <img src="/<?= $joueur['photo'] ?>" alt="photo">
                </div>
                <div class="panel-body">
                    <header>
                        <h3>
                            <?= $joueur['prenom'] ?> <?= $joueur['nom_joueur'] ?>
                            <small><span class="poste"><?= $joueur['nom_poste'] ?></span></small>
                        </h3>
                    </header>
                    <div class="infos">
                        <ul>
                            <li><?= $joueur['taille'] ?> cm</li>
                            <li><?= $joueur['poids'] ?> kg</li>
                            <li><?= $joueur['commentaire'] ?></li>
                        </ul>
                    </div>
                    <div>
                        <a href="/matchs/titulaire/<?= $data['id_match'] ?>/<?= $joueur['numero_licence'] ?>">Titulaire</a>
                        <a href="/matchs/remplacant/<?= $data['id_match'] ?>/<?= $joueur['numero_licence'] ?>">Remplacant</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
