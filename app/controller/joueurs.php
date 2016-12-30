<?php
class Joueurs extends Controller
{
    /**
     * Affiche la liste de tous les joueurs
     */
    public function index()
    {
        try {
            $model = $this->model('Mod_Joueurs');
            $joueurs = $model->getJoueursBasicInfo();
        } catch (Exception $e) {
            $this->view('joueurs/index', ['error' => 'Une erreur est survenue, veuillez contacter le webmestre.']);
        }
        $this->view('joueurs/index', ['joueurs' => $joueurs]);
    }

    /**
     * Ajouter un joueur à la base de donnée
     */
    public function add()
    {
        //S'il y a une variable post
        if (!empty($_POST)) {
            //Si tout est bien rentré
            if (!empty($_POST['num']) && !empty($_POST['nom']) && !empty($_POST['prenom'])
                && !empty($_POST['ddn']) && !empty($_POST['taille']) && !empty($_POST['poids'])
                && !empty($_POST['id_poste']) && !empty($_FILES['photo'])
            ) {
                //Sécurisation des données
                $data = $this->securiserDonnees($_POST);

                //Verification du type de la photo
                $allowed_extentions = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!in_array($_FILES['photo']['type'], $allowed_extentions))
                    $error = "La photo doit être de type PNG ou JPG.";

                //Vérification de la taille de la photo
                $max_size = 2000000;
                if ($_FILES['photo']['size'] > $max_size)
                    $error = "La photo doit peser moins de 2 Mo.";


                if (empty($error)) {
                    //On upload l'imgage
                    $extention = explode('/', $_FILES['photo']['type']);
                    $photo = 'uploads/photos_joueurs/' . $data['num'] . '.' . $extention[1];
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo)) {
                        //On essaye de mettre les donnees dans la db
                        try {
                            $model = $this->model('Mod_Joueurs');
                            $res = $model->insererJoueur($data['num'], $data['nom'], $data['prenom'], $data['ddn'],
                                $data['taille'], $data['poids'], $data['id_poste'], $photo);
                            //On affiche une page de succes qui propose d'en ajouter un autre ou voir le joueur
                            if ($res) {
                                header('Location:/joueurs/add_success');
                            }
                            else
                                $this->view('joueurs/add', ['error' => 'Erreur lors de l\'insertion dans la base de donnée']);
                        } catch (Exception $e) {
                            $this->view('joueurs/add', ['error' => 'Erreur lors de l\'insertion dans la base de donnée : ' . $e->getMessage()]);
                        }
                    } else
                        $this->view('joueurs/add', ['error' => 'Erreur lors du téléchargement de la photo. Veuillez rééssayer.']);
                } else
                    $this->view('joueurs/add', ['error' => $error]);
            } else
                $this->view('joueurs/add', ['error' => 'Vous devez compléter tous les champs']);
        }
        //Sinon on affiche le formulaire
        else
            $this->view('joueurs/add');
    }

    /**
     * Modifier un joueur
     * @param $num
     */
    public function edit($num)
    {
        $joueur = $this->model('Mod_Joueurs')->getJoueurNumLicence($num);
        $postes = $this->model('Mod_Postes')->getPostes();
        $status = $this->model('Mod_Status')->getStatus();
        //S'il y a une variable post
        if (!empty($_POST)) {
            //Si rien n'est vide
            if ($this->isAllInputsCompleted(['num', 'nom', 'prenom', 'ddn', 'taille', 'poids', 'id_poste', 'status'])) {
                //On sécurise les valeurs
                $inputs = $this->securiserDonnees($_POST);
                //On envois les valeurs
                $res = $this->model('Mod_Joueurs')->updatePlayer($inputs['num'], $inputs['nom'], $inputs['prenom'],
                $inputs['ddn'], $inputs['taille'], $inputs['poids'], $inputs['id_poste'], $inputs['status'], $inputs['commentaire']);
                if ($res) {
                    header('Location:/joueurs/get/' . $inputs['num']);
                }
                else
                    $this->view('joueurs/edit', ['joueur' => $joueur, 'postes' => $postes, 'status' => $status,
                        'error' => 'Erreur lors de la mise a jour du joueur, veuillez rééssayer']);
            }
            else
                $this->view('joueurs/edit', ['joueur' => $joueur, 'postes' => $postes, 'status' => $status,
                    'error' => 'Veuillez remplir tous les champs']);
        }
        else {
            $this->view('joueurs/edit', ['joueur' => $joueur, 'postes' => $postes, 'status' => $status]);
        }
    }

    /**
     * Supprimer un joueur
     * @param $num
     */
    public function delete($num) {
        //securise le numero
        $num = htmlentities(addslashes($num));

        //Verifier si un numero est rentré
        if ($num == "")
            echo "Pas de num";
            //header('Location:/joueurs');

        $model = $this->model('Mod_Joueurs');
        //Verifier si je joueur existe
        if (!$model->isJoueurExists($num))
            //header('Location:/joueurs');
            echo "Joueur not exixts";

        $joueur = $model->getJoueurBasicInfo($num);

        //Si on a confirmé la suppression
        if (isset($_POST['delete'])) {
            $res = $model->deleteJoueur($num);
            if ($res) {
                unlink($joueur['photo']);
                header('Location:/joueurs');
            }
            else
                $this->view('joueurs/delete', ['joueur' => $joueur,
                    'error' => 'Erreur lors de la suppression du joueur, veuillez rééssayer.']);
        }
        else {
            var_dump($_POST);
            $this->view('joueurs/delete', ['joueur' => $joueur]);
        }



    }

    /**
     * Affiche la page de succes lors de l'ajout d'un joueur
     */
    public function add_success()
    {
        $this->view('joueurs/add_result');
    }

    /**
     * Afficher les details un joueur
     * @param $num
     */
    public function get($num)
    {
        $joueur = $this->model('Mod_Joueurs')->getJoueurNumLicence($num);
        $this->view('joueurs/get', ['joueur' => $joueur]);
    }

    /**
     * Securise les données contenues dans le tableau $data
     * @param $data
     * @return array
     */
    private function securiserDonnees($data) {
        $return = [];
        foreach ($data as $key => $value) {
            $return[$key] = $value;
        }
        return $return;
    }

    /**
     * Retourne vrai si tous les inputs sont remplis
     * @param $inputs
     * @return bool
     */
    private function isAllInputsCompleted($inputs)
    {
        $return = true;
        foreach ($inputs as $i){
            if (empty($_POST[$i]))
                $return = false;
        }
        return $return;
    }
}