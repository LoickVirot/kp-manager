<?php

class matchs extends Controller
{
    public function index()
    {
        // Recuperer le nom de notre équipe
        $appInfo = require_once "../app/config/app.php";
        // Récuperer les matchs
        $matchs = $this->model('Mod_Matchs')->getMatchs();
        $this->view('matchs/index', ['team' => $appInfo['team'], 'matchs' => $matchs]);
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
                    $this->view("matchs/add", ['error' => $error]);
                }

            }
            else {
                $error = "Tous les champs doivent être remplis";
                $this->view("matchs/add", ['error' => $error]);
            }

        }
        else
        {
            $this->view("matchs/add", []);
        }
    }
}