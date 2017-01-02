<h1>Ajouter un match</h1>
<?php if (isset($data['error'])) : ?>
    <div class="alert alert-danger">
        <?= $data['error'] ?>
    </div>
<?php endif; ?>
<form action="/matchs/add" method="post">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><?= $data['team'] ?> VS </span>
            <input type="text" class="form-control" name="adversaire" placeholder="Adversaire" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Date</span>
            <input type="date" class="form-control" name="date" placeholder="jj/mm/aaaa" required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Lieu</span>
            <select class="form-control" name="lieu">
                <option value="domicile">Domicile</option>
                <option value="exterieur">Exterieur</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>