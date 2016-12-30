<h1>Ajouter un joueur</h1>
<?php if (!empty($data['error'])) : ?>
    <div class="alert alert-danger">
        <?= $data['error'] ?>
    </div>
<?php endif?>
<form action="/joueurs/add" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Numero de license</span>
            <input type="text" class="form-control" name="num" placeholder="123456" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Nom</span>
            <input type="text" class="form-control" name="nom" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Prenom</span>
            <input type="text" class="form-control" name="prenom" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Date de naissance</span>
            <input type="date" class="form-control" name="ddn" placeholder="__/__/____" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Taille</span>
            <input type="number" class="form-control" name="taille" placeholder="Centimètres" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Poids</span>
            <input type="number" class="form-control" name="poids" placeholder="Kilogrammes" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Poste</span>
            <select class="form-control" name="id_poste">
                <?php foreach ($data['postes'] as $poste) : ?>
                    <option value="<?= $poste['id_poste'] ?>"><?= $poste['nom'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    Fichier : <input type="file" name="photo">
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>