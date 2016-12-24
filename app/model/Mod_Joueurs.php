<?php
class Mod_Joueurs extends Database
{

    public function getJoueursBasicInfo()
    {
        return $this->select("
        SELECT numero_licence, nom, prenom, photo
        FROM joueurs
        ORDER BY nom, prenom;
        ");
    }

    public function getJoueurNumLicence($num)
    {
        return $this->selectOne("
        SELECT *
        FROM joueurs
        WHERE numero_licence = $num;
        ");
    }

    public function insererJoueur($num, $nom, $prenom, $ddn, $taille, $poids, $id_poste, $photo)
    {
        return $this->insert("
            INSERT INTO joueurs(numero_licence, nom, prenom, photo, ddn, taille, poids, poste)
            VALUES('$num', '$nom', '$prenom', '$photo', '$ddn', '$taille', '$poids', '$id_poste')
        ");
    }

    public function updatePlayer($num, $nom, $prenom, $ddn, $taille, $poids)
    {
        return $this->insert("
        UPDATE joueurs
        SET numero_licence='$num', nom='$nom', prenom='$prenom', ddn='$ddn', taille='$taille', poids='$poids'
        WHERE numero_licence='$num';
        ");
    }
}