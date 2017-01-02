<h1>Supprimer un match</h1>
<?php if (isset($data['error'])) : ?>
    <div class="alert alert-danger">
        <?= $data['error'] ?>
    </div>
<?php endif; ?>
<div class="alert alert-danger">
    Êtes vous sur de vouloir supprimer le match <?= $data['team'] ?> VS <?= $data['match']['adversaire'] ?> du <?= date('d/m/Y', strtotime($data['match']['date'])) ?> ?
    <form action="/matchs/delete/<?= $data['match']['id_match'] ?> " method="post">
        <input type="submit" name="delete" class="btn btn-danger" value="Supprimer">
    </form>
</div>

