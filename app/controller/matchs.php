<?php

class matchs extends Controller
{
    private $team;
    private $date;

    public function __construct()
    {
        // Recuperer le nom de notre équipe
        $appInfo = require_once "../app/config/app.php";
        $this->team = $appInfo['team'];

        $this->date = new DateTime(date('d-m-Y'));
    }

    public function index()
    {
        // Récuperer les matchs
        $matchs = $this->model('Mod_Matchs')->getMatchs();

        foreach ($matchs as $key => $match) {
            //Vérification de la date du match
            $matchDate = new DateTime(date('d-m-Y', strtotime($match['date'])));
            $matchs[$key]['isMatchFinished'] = $matchDate <= $this->date;
        }


        $this->view('matchs/index', ['team' => $this->team, 'matchs' => $matchs]);
    }

    public function get($id_match) {

        //On sécurise l'id du match
        $id_match = addslashes(htmlentities($id_match));

        //On vérifie si le match existe
        $model = $this->model('Mod_Matchs');
        if (!$model->isMatchExists($id_match)) {
            header('Location:/matchs');
            return;
        }

        //Récuperation du match
        $match = $model->getMatch($id_match);

        //Récupération des joueurs sélectionnés
        $players = $model->getSelectedPlayers($id_match);

        //Vérification de la date du match
        $matchDate = new DateTime(date('d-m-Y', strtotime($match['date'])));
        $isMatchFinished = $matchDate <= $this->date;

        //Affichage de la page de match
        $this->view('matchs/get', [
            'team' => $this->team,
            'match' => $match,
            'players' => $players,
            'isMatchFinished' => $isMatchFinished
        ]);
    }

    public function add()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['adversaire']) && !empty($_POST['date']) && !empty($_POST['lieu'])) {
                $adversaire = htmlentities(addslashes($_POST['adversaire']));
                $date = htmlentities(addslashes($_POST['date']));
                $lieu = htmlentities(addslashes($_POST['lieu']));

                $model = $this->model('Mod_Matchs');
                $res = $model->addMatch($adversaire, $date, $lieu);

                if ($res)
                    header('Location:/matchs');
                else {
                    $error = "Problème lors de l'ajout du match dans la base de donnée";
                    $this->view("matchs/add", ['error' => $error, 'team' => $this->team]);
                }

            }
            else {
                $error = "Tous les champs doivent être remplis";
                $this->view("matchs/add", ['error' => $error, 'team' => $this->team]);
            }

        }
        else
        {
            $this->view("matchs/add", ['team' => $this->team]);
        }
    }

    public function edit($id_match) {
        //On sécurise l'id du match
        $id_match = addslashes(htmlentities($id_match));

        //On vérifie si le match existe
        $model = $this->model('Mod_Matchs');
        if (!$model->isMatchExists($id_match)) {
            header('Location:/matchs');
            return;
        }

        //Récuperation du match
        $match = $model->getMatch($id_match);

        //Récupération des joueurs sélectionnés
        $players = $model->getSelectedPlayers($id_match);

        //Vérification de la date du match
        $matchDate = new DateTime(date('d-m-Y', strtotime($match['date'])));
        $isMatchFinished = $matchDate <= $this->date;

        //On vérifie s'il existe une variable post, sinon on affiche la page normalement
        if (empty($_POST)) {
            $this->view('matchs/edit', [
                'team' => $this->team,
                'match' => $match,
                'players' => $players,
                'isMatchFinished' => $isMatchFinished
            ]);
            return;
        }

        //On vérifie que tous les inputs sont entrés
        if (empty($_POST['adversaire']) || empty($_POST['date']) || empty($_POST['lieu'])) {
            $this->view('matchs/edit', [
                'team' => $this->team,
                'match' => $match,
                'players' => $players,
                'error' => 'Veuillez remplir tous les champs']);
            return;
        }

        //On sécurise les données
        $inputs = [];
        foreach ($_POST as $key => $value) {
            $inputs[$key] = htmlentities(addslashes(htmlentities($value)));
        }

        //On met à jour le match
        $res = $model->updateMatch($id_match, $inputs['adversaire'], $inputs['date'], $inputs['lieu'], $inputs['score_team'], $inputs['score_adv']);

        //On vérifie que tout s'est bien passé
        if (!$res) {
            $this->view('matchs/edit', [
                'team' => $this->team,
                'match' => $match,
                'players' => $players,
                'error' => 'Quelque chose s\'est mal passe, veuillez rééssayer']);
            return;
        }

        header('Location:/matchs');
    }

    public function delete($id_match) {
        //On sécurise l'id du match
        $id_match = addslashes(htmlentities($id_match));

        //On vérifie si le match existe
        $model = $this->model('Mod_Matchs');
        if (!$model->isMatchExists($id_match)) {
            header('Location:/matchs');
            return;
        }

        $match = $model->getMatch($id_match);

        //S'il y a pas de variable post, on affiche la page
        if (empty($_POST['delete'])) {
            $this->view('matchs/delete', ['team' => $this->team, 'match' => $match]);
            return;
        }

        $res = $model->deleteMatch($id_match);
        if (!$res) {
            $this->view('matchs/delete', ['team' => $this->team, 'match' => $match, 'error' => 'Il y a eu un problème lors de la suppression du match, veuillez rééssayer']);
            return;
        }

        header('Location:/matchs');
    }

    public function selection($id_match)
    {
        //On sécurise l'id du match
        $id_match = addslashes(htmlentities($id_match));

        //On vérifie si le match existe
        $model = $this->model('Mod_Matchs');
        if (!$model->isMatchExists($id_match)) {
            header('Location:/matchs');
            return;
        }

        //On récupère le match pour vérifier la date
        $match = $model->getMatch($id_match);
        $matchDate = new DateTime(date('d-m-Y', strtotime($match['date'])));
        if ($matchDate <= $this->date) {
            header("Location:/matchs/get/$id_match");
            return;
        }

        //On récupère la liste des joueurs
        $joueurs = $this->model('Mod_Joueurs')->getJoueursForSelection($id_match);

        //Si pas de variable post, on affiche la page
        if (empty($_POST)) {
            $this->view('matchs/selection', ['id_match' => $id_match, 'joueurs' => $joueurs]);
            return;
        }

        //On sécurise les données
        $players = [];
        foreach ($_POST as $input) {
            array_push($players, htmlentities(addslashes(htmlentities($input))));
        }
        
        $results = $model->addPlayersToSelection($id_match, $players);

        //On vérifie que tout est bien rentré, sinon on veut afficher des messages d'erreur
        $errors = [];
        foreach ($results as $player => $res) {
            if (!$res) {
                array_push($errors, "Le joueur $player n'a pas pu être sélectionné. Veuillez rééssayer");
                $isError = true;
            }
        }

        //Si une erreur doit être affichée
        if (isset($isError) && $isError) {
            $this->view('matchs/selection', ['id_match' => $id_match, 'joueurs' => $joueurs, 'errors' => $errors]);
            return;
        }
        
        header("Location:/matchs/edit/$id_match");
    }

    public function remove($id_match, $num)
    {
        //On sécurise les entrees
        $id_match = addslashes(htmlentities($id_match));
        $num = addslashes(htmlentities($num));

        $model = $this->model('Mod_Matchs');

        //On vérifie si le match existe
        if (!$model->isMatchExists($id_match)) {
            header('Location:/matchs');
            return;
        }

        $res = $model->removeOfMatch($id_match, $num);
        if (!$res) {
            header("Location:/matchs/get/$id_match");
            return;
        }

        header("Location:/matchs/get/$id_match");

    }

    public function titulaire($id_match, $num) {
        //On sécurise les entrees
        $id_match = addslashes(htmlentities($id_match));
        $num = addslashes(htmlentities($num));
        $this->participerAuMatch($id_match, $num, "titulaire");
    }

    public function remplacant($id_match, $num) {
        //On sécurise les entrees
        $id_match = addslashes(htmlentities($id_match));
        $num = addslashes(htmlentities($num));
        $this->participerAuMatch($id_match, $num, "remplacement");
    }

    public function note($id_match, $num)
    {
        //On sécurise les entrees
        $id_match = addslashes(htmlentities($id_match));
        $num = addslashes(htmlentities($num));

        $model = $this->model('Mod_Matchs');

        //On vérifie si le match existe
        if (!$model->isMatchExists($id_match)) {
            header('Location:/matchs');
            return;
        }

        //On vérifie que POST n'est pas vide
        if (empty($_POST)) {
            header("Location:/matchs/get/$id_match");
            return;
        }

        //On sécurise le champs en vérifiant qu'il s'agit bien d'un nombre entre 1 et 5
        if ($_POST['note'] < 0 or $_POST['note'] > 5) {
            header("Location:/matchs/get/$id_match");
            return;
        }

        //On ajoute la note
        $res = $model->note($id_match, $num, $_POST['note']);
        if (!$res) {
            header("Location:/matchs/get/$id_match");
            return;
        }

        header("Location:/matchs/get/$id_match");
    }

    private function participerAuMatch($id_match, $num, $status) {

        $model = $this->model('Mod_Matchs');

        //On vérifie si le match existe
        if (!$model->isMatchExists($id_match)) {
            header('Location:/matchs');
            return;
        }

        $res = $model->addToMatch($id_match, $num, $status);
        if (!$res) {
            header("Location:/matchs/selection/$id_match");
            return;
        }

        header("Location:/matchs/selection/$id_match");
        
    }
}