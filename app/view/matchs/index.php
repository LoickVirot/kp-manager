<h1>Matchs <small><a href="/matchs/add"><span class="glyphicon glyphicon-plus"></span> Ajouter un match</a></small></h1>
<div class="matchs-list">
    <?php foreach ($data['matchs'] as $match) : ?>
        <div class="date">
            <?= date("d/m/Y", strtotime($match['date'])) ?>
            <a href="/matchs/get/<?= $match['id_match'] ?>"><span class="glyphicon glyphicon-zoom-in"></span> Afficher</a>
        </div>
        <?php $match['lieu'] == "domicile" ? $class = 'match' : $class = 'match-reverse' ?>
        <div class="<?= $class ?>">
            <div class="team">
                <h3><?= $data['team'] ?></h3>
                <h3><?= $match['score_team'] ?></h3>
            </div>
            <div class="between"></div>
            <div class="adv">
                <h3><?= $match['score_adv'] ?></h3>
                <h3><?= $match['adversaire'] ?></h3>
            </div>
        </div>
        <div class="divider"></div>
    <?php endforeach; ?>
</div>