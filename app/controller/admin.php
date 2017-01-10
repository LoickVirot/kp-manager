<?php

/**
 * Created by PhpStorm.
 * User: marty
 * Date: 09/12/16
 * Time: 13:31
 */
class admin extends Controller
{
    public function index()
    {
        $joueurs = $this->model("Mod_Joueurs")->getJoueursBasicInfo();
        $nextMatch = $this->model("Mod_Matchs")->getNextMatch();
        $app = require_once "../app/config/app.php";
        $this->view('admin/index', [
            'joueurs' => $joueurs,
            'next_match' => $nextMatch,
            'team' => $app['team']
        ]);
    }
}