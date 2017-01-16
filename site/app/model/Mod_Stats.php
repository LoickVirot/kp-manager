<?php

class Mod_Stats extends Database
{

    public function countAllMatchsWin()
    {
        return $this->selectOne("
            SELECT COUNT(*)
            FROM matchs
            WHERE matchs.score_team > matchs.score_adv
            AND matchs.date <= CURRENT_DATE
        ");
    }

    public function countAllMatchsEqual()
    {
        return $this->selectOne("
            SELECT COUNT(*)
            FROM matchs
            WHERE matchs.score_team = matchs.score_adv
            AND matchs.date <= CURRENT_DATE
        ");
    }

    public function countAllMatchsLoose()
    {
        return $this->selectOne("
            SELECT COUNT(*)
            FROM matchs
            WHERE matchs.score_team < matchs.score_adv
            AND matchs.date <= CURRENT_DATE
        ");
    }

    public function countAllMatchs()
    {
        return $this->selectOne("
            SELECT COUNT(*)
            FROM matchs
            WHERE matchs.date <= CURRENT_DATE
        ");
    }

    public function getJoueursStats()
    {
        return $this->select("
            SELECT j.nom, j.prenom, s.libelle as statut, po.nom as poste_pref,
            AVG(pa.note) as moyenne,
            SUM(CASE WHEN pa.titulaire THEN 1 ELSE 0 END) as nb_titulaire,
            SUM(CASE WHEN not pa.titulaire THEN 1 ELSE 0 END) as nb_remplacant,
            COUNT(m.id_match) as nb_match,
            SUM(CASE WHEN m.score_team > m.score_adv THEN 1 ELSE 0 END) as nb_gagnes
            FROM joueurs j, participation pa, postes po, status s, matchs m
            WHERE j.numero_licence = pa.num_licence
            AND m.id_match = pa.id_match
            AND j.poste = po.id_poste
            AND j.status = s.id_status
            AND m.date <= CURRENT_DATE
            GROUP BY j.numero_licence
        ");
    }
}
