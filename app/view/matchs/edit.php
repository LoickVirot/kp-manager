<h1>Modifier un match <small><a href="/matchs/selection/<?= $data['match']['id_match'] ?>">Sélection</a></small></h1>
<?php if (isset($data['error'])) : ?>
    <div class="alert alert-danger">
        <?= $data['error'] ?>
    </div>
<?php endif; ?>
<form action="/matchs/edit/<?= $data['match']['id_match'] ?>" method="post">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><?= $data['team'] ?> VS </span>
            <input type="text" class="form-control" name="adversaire" value="<?= $data['match']['adversaire'] ?>" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Date</span>
            <input type="date" class="form-control" name="date" placeholder="jj/mm/aaaa" value="<?= $data['match']['date'] ?>" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Lieu</span>
            <select class="form-control" name="lieu">
                <option value="domicile" <?= $data['match']['lieu'] == "domicile" ? "selected" : "" ?>>Domicile</option>
                <option value="exterieur" <?= $data['match']['lieu'] == "domicile" ? "" : "selected" ?>>Exterieur</option>
            </select>
        </div>
    </div>
    <div class="divider"></div>
    <div class="form-inline">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Score <?= $data['team'] ?></span>
                <input type="number" class="form-control" name="score_team" value="<?= $data['match']['score_team'] ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Score <?= $data['match']['adversaire'] ?></span>
                <input type="number" class="form-control" name="score_adv" value="<?= $data['match']['score_adv'] ?>">
            </div>
        </div>
    </div>
    <br>
    <div>
        <a href="/matchs/delete/<?= $data['match']['id_match'] ?>" class="text-danger"><span class="glyphicon glyphicon-trash"></span> Supprimer le match</a>
    </div>
    <br>
    <div>
        <a href='/matchs/get/<?= $data['match']['id_match'] ?>' class="btn btn-default">Annuler</a>
        <button type="submit" class="btn btn-primary">Appliquer</button>
    </div>
</form>