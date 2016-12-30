<h1>Joueurs</h1>
<table class="table table-hover players-list">
    <thead>
        <th>Numéro de licence</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Photo</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($data['joueurs'] as $joueur) : ?>
                <tr>
                    <td><?=$joueur['numero_licence']?></td>
                    <td><a href="/joueurs/get/<?=$joueur['numero_licence']?>"><?=$joueur['nom']?></a></td>
                    <td><?=$joueur['prenom']?></td>
                    <td><img src="/<?=$joueur['photo']?>" alt="photo" class="player-photo"></td>
                    <td>
                        <a href="/joueurs/delete/<?=$joueur['numero_licence']?>" class="text-danger"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
                    </td>
                </tr>
        <?php endforeach; ?>
    </tbody>
</table>
