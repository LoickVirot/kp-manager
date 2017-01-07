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
        SELECT j.numero_licence, j.nom, j.prenom, j.photo, p.nom as poste
        FROM joueurs j, postes p
        WHERE p.id_poste = j.poste
        ORDER BY j.nom, j.prenom
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
        SELECT j.numero_licence, j.nom, j.prenom, j.photo, j.ddn, j.taille, j.poids, j.commentaire, p.id_poste, p.nom as poste, s.libelle as status
        FROM joueurs j, postes p, status s 
        WHERE j.poste=p.id_poste
        AND j.status = s.id_status
        AND j.numero_licence = '$num'
        ");
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

    /**
     * Retourne la liste des joueurs pouvant participer aux matchs
     * @return array
     */
    public function getJoueursForSelection($id_match)
    {
        return $this->select("
        SELECT j.numero_licence, j.prenom, j.photo, j.ddn, j.taille, j.poids, j.commentaire, j.nom as nom_joueur, p.nom as nom_poste
        FROM joueurs j, postes p
        WHERE j.poste = p.id_poste
        AND status = 1
        AND j.numero_licence NOT IN (SELECT num_licence
                                 FROM participation pa, joueurs j
                                 WHERE j.numero_licence = pa.num_licence
                                 AND pa.id_match = '$id_match')
        ORDER BY nom_joueur, j.prenom
        ");
    }
}