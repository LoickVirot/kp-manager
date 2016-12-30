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
}