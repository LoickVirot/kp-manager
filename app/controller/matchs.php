<?php

class matchs extends Controller
{
    private $team;

    public function __construct()
    {
        // Recuperer le nom de notre équipe
        $appInfo = require_once "../app/config/app.php";
        $this->team = $appInfo['team'];
    }

    public function index()
    {
        // Récuperer les matchs
        $matchs = $this->model('Mod_Matchs')->getMatchs();
        $this->view('matchs/index', ['team' => $this->team, 'matchs' => $matchs]);
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

        $match = $model->getMatch($id_match);

        //On vérifie s'il existe une variable post, sinon on affiche la page normalement
        if (empty($_POST)) {
            $this->view('matchs/edit', ['team' => $this->team, 'match' => $match]);
            return;
        }

        //On vérifie que tous les inputs sont entrés
        if (empty($_POST['adversaire']) || empty($_POST['date']) || empty($_POST['lieu'])) {
            $this->view('matchs/edit', ['team' => $this->team, 'match' => $match, 'error' => 'Veuillez remplir tous les champs']);
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
            $this->view('matchs/edit', ['team' => $this->team, 'match' => $match, 'error' => 'Quelque chose s\'est mal passe, veuillez rééssayer']);
            return;
        }

        header('Location:/matchs');


    }
}