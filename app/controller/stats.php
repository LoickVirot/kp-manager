<?php
class stats extends Controller
{

    public function index()
    {

        $statsModel = $this->model('Mod_Stats');

        $nbMatchsWin = $statsModel->countAllMatchsWin();
        $nbMatchsEqual = $statsModel->countAllMatchsEqual();
        $nbMatchsLoose = $statsModel->countAllMatchsLoose();

        $playerStats = $statsModel->getJoueursStats();

        //Afficher la vue
        $this->view('stats/index', [
            'matchs' => [
                'win' => $nbMatchsWin[0],
                'equal' => $nbMatchsEqual[0],
                'loose' => $nbMatchsLoose[0]
            ],
            'joueurs' => $playerStats
        ]);
    }
}