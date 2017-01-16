<?php

class Mod_Matchs extends Database
{
    public function getMatchs() {
        return $this->select("
        SELECT *
        FROM matchs
        ORDER BY date DESC ");
    }

    public function addMatch ($adversaire, $date, $lieu)
    {
        return $this->insert("
            INSERT INTO matchs (adversaire, date, lieu, score_team, score_adv)
            VALUES ('$adversaire', '$date', '$lieu', 0, 0)");
    }

    public function isMatchExists($id_match) {
        $res = $this->count(
            "SELECT COUNT(id_match)
            FROM matchs
            WHERE id_match = '$id_match'"
        );
        return $res == 1;
    }

    public function getMatch($id_match) {
        return $this->selectOne(
            "SELECT *
            FROM matchs
            WHERE id_match = '$id_match'"
        );
    }

    public function getNextMatch()
    {
        return $this->selectOne("
            SELECT *
            FROM matchs m
            WHERE m.date >= CURRENT_DATE
            LIMIT 1
            ");
    }

    public function updateMatch($id_match, $adv, $date, $lieu, $score_team = 0, $score_adv = 0)
    {
        return $this->insert(
            "UPDATE matchs
            SET adversaire='$adv', date='$date', lieu='$lieu', score_team='$score_team', score_adv='$score_adv'
            WHERE id_match = '$id_match'"
        );
    }

    public function deleteMatch($id_match)
    {
        return $this->insert("
        DELETE FROM matchs WHERE id_match='$id_match'
        ");
    }

    /**
     * Retourne les joueurs participant au match
     * @param $id_match
     * @return array
     */
    public function getSelectedPlayers($id_match) {
        //On récupère la liste des numeros de licenses qui participent
        $players = $this->select("
        SELECT j.numero_licence, j.nom, j.prenom, j.photo, p.titulaire, p.note, po.nom as nom_poste
        FROM participation p, joueurs j, postes po
        WHERE p.num_licence = j.numero_licence
        AND j.poste = po.id_poste
        AND p.id_match = '$id_match'
        ORDER BY p.titulaire DESC, j.nom, j.prenom
        ");

        return $players;
    }

    public function addToMatch($id_match, $num, $titulaire)
    {
        return $this->insert("
        INSERT INTO participation(id_match, num_licence, titulaire)
        VALUES ('$id_match', '$num', '$titulaire')
        ");
    }

    public function removeOfMatch($id_match, $num)
    {
        return $this->insert("
        DELETE FROM participation
        WHERE id_match = '$id_match'
        AND num_licence = '$num'
        ");
    }

    public function note($id_match, $num, $note)
    {
        return $this->insert("
        UPDATE participation
        SET note = '$note'
        WHERE id_match='$id_match'
        AND num_licence='$num'
        ");
    }

}
