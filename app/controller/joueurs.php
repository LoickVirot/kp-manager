<?php

/**
 * Created by PhpStorm.
 * User: marty
 * Date: 22/12/16
 * Time: 19:44
 */
class Joueurs extends Controller
{
    public function index()
    {
        $this->view('joueurs/index');
    }

    public function add()
    {
        //S'il y a une variable post
            //Si tout est bien rentré
                //On sécurise les donnees
                //On essaye de mettre les donnees dans la db
                    //On affiche une page de succes qui propose d'en ajouter un autre ou voir le joueur
                //Sinon on affiche un message d'erreur
            //Sinon on affiche un message d'erreur
        //Sinon on affiche le formulaire
        $this->view('joueurs/add');
    }
}