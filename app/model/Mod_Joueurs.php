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
        $joueur = $this->selectOne("
        SELECT *
        FROM joueurs
        WHERE numero_licence = $num;
        ");
        $poste = $this->selectOne("
        SELECT nom
        FROM postes
        WHERE id_poste = '". $joueur['poste'] ."' ");
        $joueur['poste'] = $poste['nom'];
        return $joueur;
    }

    public function insererJoueur($num, $nom, $prenom, $ddn, $taille, $poids, $id_poste, $photo)
    {
        return $this->insert("
            INSERT INTO joueurs(numero_licence, nom, prenom, photo, ddn, taille, poids, poste)
            VALUES('$num', '$nom', '$prenom', '$photo', '$ddn', '$taille', '$poids', '$id_poste')
        ");
    }

    public function updatePlayer($num, $nom, $prenom, $ddn, $taille, $poids, $poste)
    {
        return $this->insert("
        UPDATE joueurs
        SET numero_licence='$num', nom='$nom', prenom='$prenom', ddn='$ddn', taille='$taille', poids='$poids', poste='$poste'
        WHERE numero_licence='$num';
        ");
    }
}