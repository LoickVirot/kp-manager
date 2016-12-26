<?php

class Mod_Postes extends Database
{
    public function getPostes()
    {
        return $this->select("SELECT * FROM postes");
    }
}