<?php
class stats extends Controller
{

    public function index()
    {

        $statsModel = $this->model('Mod_Stats');

        $nbMatchsWin = $statsModel->countAllMatchsWin();
        $nbMatchsEqual = $statsModel->countAllMatchsEqual();
        $nbMatchsLoose = $statsModel->countAllMatchsLoose();
        $nbMatchs = $statsModel->countAllMatchs();

        $playerStats = $statsModel->getJoueursStats();

        //Afficher la vue
        $this->view('stats/index', [
            'matchs' => [
                'win' => $nbMatchsWin[0],
                'equal' => $nbMatchsEqual[0],
                'loose' => $nbMatchsLoose[0],
                'total' => $nbMatchs[0]
            ],
            'joueurs' => $playerStats
        ]);
    }
}
