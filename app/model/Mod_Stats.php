<?php

class Mod_Stats extends Database
{

    public function countAllMatchsWin()
    {
        return $this->selectOne("
            SELECT COUNT(*)
            FROM matchs
            WHERE matchs.score_team > matchs.score_adv
            AND matchs.date < CURRENT_DATE
        ");
    }

    public function countAllMatchsEqual()
    {
        return $this->selectOne("
            SELECT COUNT(*)
            FROM matchs
            WHERE matchs.score_team = matchs.score_adv
            AND matchs.date < CURRENT_DATE
        ");
    }

    public function countAllMatchsLoose()
    {
        return $this->selectOne("
            SELECT COUNT(*)
            FROM matchs
            WHERE matchs.score_team < matchs.score_adv
            AND matchs.date < CURRENT_DATE
        ");
    }
}