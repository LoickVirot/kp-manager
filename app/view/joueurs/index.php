<h1>Joueurs</h1>
<table class="table players-list">
    <thead>
        <th>Numéro de licence</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Photo</th>
    </thead>
    <tbody>
        <?php foreach ($data['joueurs'] as $joueur) : ?>
        <tr>
            <td><?=$joueur['numero_licence']?></td>
            <td><?=$joueur['nom']?></td>
            <td><?=$joueur['prenom']?></td>
            <td><img src="/<?=$joueur['photo']?>" alt="photo" class="player-photo"></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
