<?php
class Mod_Joueurs extends Database
{

    /**
     * Recupère les infos basiques des joueurs (numero, nom, prenom et photo)
     * @return array
     */
    public function getJoueursBasicInfo()
    {
        return $this->select("
        SELECT numero_licence, nom, prenom, photo
        FROM joueurs
        ORDER BY nom, prenom;
        ");
    }

    /**
     * Recupère les infos basiques d'un joueur (numero, nom, prenom et photo)
     * @param $num
     * @return array
     */
    public function getJoueurBasicInfo($num)
    {
        return $this->selectOne("
        SELECT numero_licence, nom, prenom, photo
        FROM joueurs
        WHERE numero_licence = '$num'
        ");
    }

    /**
     * Récupère toutes les infos d'un joueur avec son numero de licence
     * @param $num
     * @return mixed
     */
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
        $status = $this->selectOne("
        SELECT libelle
        FROM status
        WHERE id_status = '". $joueur['status'] ."' ");
        $joueur['poste'] = $poste['nom'];
        $joueur['status'] = $status['libelle'];
        return $joueur;
    }

    /**
     * Insère un joueur dans la base de données
     * @param $num
     * @param $nom
     * @param $prenom
     * @param $ddn
     * @param $taille
     * @param $poids
     * @param $id_poste
     * @param $photo
     * @return bool
     */
    public function insererJoueur($num, $nom, $prenom, $ddn, $taille, $poids, $id_poste, $photo)
    {
        return $this->insert("
            INSERT INTO joueurs(numero_licence, nom, prenom, photo, ddn, taille, poids, poste)
            VALUES('$num', '$nom', '$prenom', '$photo', '$ddn', '$taille', '$poids', '$id_poste')
        ");
    }

    /**
     * Met à jour un joueur
     * @param $num
     * @param $nom
     * @param $prenom
     * @param $ddn
     * @param $taille
     * @param $poids
     * @param $poste
     * @param $status
     * @param $commentaire
     * @return bool
     */
    public function updatePlayer($num, $nom, $prenom, $ddn, $taille, $poids, $poste, $status, $commentaire)
    {
        return $this->insert("
        UPDATE joueurs
        SET numero_licence='$num', nom='$nom', prenom='$prenom', ddn='$ddn', taille='$taille', poids='$poids', poste='$poste',
        status='$status', commentaire='$commentaire'
        WHERE numero_licence='$num';
        ");
    }

    /**
     * Supprime un joueur de la base de donnée
     * @param $num
     * @return bool
     */
    public function deleteJoueur($num)
    {
        return $this->insert("
            DELETE FROM joueurs
            WHERE numero_licence = '$num'
        ");
    }

    /**
     * Retourne vrai si le joueur existe
     * @param $num
     * @return int
     */
    public function isJoueurExists($num)
    {
        $res = $this->count("
            SELECT COUNT(numero_licence)
            FROM joueurs
            WHERE numero_licence = '$num'
        ");
        return $res;
    }
}