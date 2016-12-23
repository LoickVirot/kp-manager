<h1><?= $data['joueur']['prenom'] ?> <?= $data['joueur']['nom'] ?></h1>

<div class="row player-info">
    <div class="col-md-8">
        <p><b>Numéro de licence : </b><?= $data['joueur']['numero_licence'] ?></p>
        <p><b>Date de naissance : </b><?= $data['joueur']['ddn'] ?></p>
        <p><b>Taille : </b><?= $data['joueur']['taille'] ?></p>
        <p><b>Poids : </b><?= $data['joueur']['poids'] ?></p>
        <p><b>Status : </b><?= $data['joueur']['status'] == '' ? 'Non renseigné' : $data['joueur']['status']?></p>
        <div class="well">
            <?= $data['joueur']['commentaire'] == '' ? 'Pas de commentaire' : $data['joueur']['commentaire']?>
        </div>

    </div>
    <div class="col-md-4">
        <img src="/<?= $data['joueur']['photo'] ?>" alt="photo" class="player-photo">
    </div>
</div>