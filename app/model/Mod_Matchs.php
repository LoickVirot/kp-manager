<?php

class Mod_Matchs extends Database
{
    public function getMatchs() {
        return $this->select("
        SELECT * 
        FROM matchs
        ORDER BY date");
    }

    public function addMatch ($adversaire, $date, $lieu)
    {
        return $this->insert("
            INSERT INTO matchs (adversaire, date, lieu)
            VALUES ('$adversaire', '$date', '$lieu')");
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
     * Ajoute des joueurs à la sélection pour un match.
     * Retourne un tableau qui associe chaque joueur au résultat (vrai ou faux) de la requete.
     * @param $id_match
     * @param $players
     * @return array
     */
    public function addPlayersToSelection($id_match, $players) {
        $resReturn = [];

        foreach ($players as $player) {
            $resQuery = $this->insert("
            INSERT INTO participation(num_licence, id_match)
              VALUES('$player', '$id_match');
            ");
            $resReturn[$player] = $resQuery;
        }

        return $resReturn;
    }

    /**
     * Retourne les joueurs participant au match
     * @param $id_match
     * @return array
     */
    public function getSelectedPlayers($id_match) {
        //On récupère la liste des numeros de licenses qui participent
        $players = $this->select("
        SELECT num_licence FROM participation
        WHERE id_match = '$id_match'
        ");

        //Transform
        $requestedPlayers = [];
        foreach ($players as $player_id) {
            array_push($requestedPlayers , "'" . $player_id['num_licence'] . "'");
        }
        $requestedPlayers = implode(',', $requestedPlayers);

        $selectedPlayers = $this->select("
            SELECT * FROM `joueurs` WHERE numero_licence in ($requestedPlayers);
        ");

        return $selectedPlayers;

    }


}