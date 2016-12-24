<h1>Éditer un joueur</h1>
<?php if (!empty($data['error'])) : ?>
    <div class="alert alert-danger">
        <?= $data['error'] ?>
    </div>
<?php endif?>
<form action="/joueurs/edit/<?= $data['joueur']['numero_licence'] ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Numero de license</span>
            <input type="text" class="form-control" name="num" value="<?= $data['joueur']['numero_licence'] ?>" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Nom</span>
            <input type="text" class="form-control" name="nom" value="<?= $data['joueur']['nom'] ?>" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Prenom</span>
            <input type="text" class="form-control" name="prenom" value="<?= $data['joueur']['prenom'] ?>" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Date de naissance</span>
            <input type="date" class="form-control" name="ddn" value="<?= $data['joueur']['ddn'] ?>" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Taille</span>
            <input type="number" class="form-control" name="taille" value="<?= $data['joueur']['taille'] ?>"  required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Poids</span>
            <input type="number" class="form-control" name="poids" value="<?= $data['joueur']['poids'] ?>"  required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Poste</span>
            <select class="form-control" name="id_poste">
                <option value="1">Poste 1</option>
                <option value="2">Poste 2</option>
                <option value="3">Poste 3</option>
            </select>
        </div>
    </div>
    Fichier : <input type="file" name="photo">
    <button type="submit" class="btn btn-primary">Appliquer</button>
</form>