<?php if( !empty($data['error'])): ?>
    <div class="alert alert-danger">
        <?= $data['error'] ?>
    </div>
<?php endif; ?>
<div class="alert alert-danger">
    Êtes-vous sur de vouloir supprimer le joueur <?=$data['joueur']['prenom']?> <?=$data['joueur']['nom']?>?
    <form action="/joueurs/delete/<?=$data['joueur']['numero_licence']?>" method="post">
        <button type="submit" class="btn btn-danger" name="delete">Supprimer</button>
    </form>
</div>
