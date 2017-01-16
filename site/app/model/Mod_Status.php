<?php

class Mod_Status extends Database
{
    public function getStatus()
    {
        return $this->select("
        SELECT * FROM status
        ");
    }
}