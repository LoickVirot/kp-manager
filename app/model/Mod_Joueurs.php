<?php
class Mod_Joueurs extends Database
{

    public function insererJoueur($num, $nom, $prenom, $ddn, $taille, $poids, $id_poste, $photo)
    {
        return $this->insert("
            INSERT INTO joueurs(numero_licence, nom, prenom, photo, ddn, taille, poids, poste)
            VALUES('$num', '$nom', '$prenom', '$photo', '$ddn', '$taille', '$poids', '$id_poste')
        ");
    }
}