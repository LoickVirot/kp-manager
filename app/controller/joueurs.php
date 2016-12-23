<?php
class Joueurs extends Controller
{
    public function index()
    {
        $this->view('joueurs/index');
        
    }

    public function add()
    {
        //S'il y a une variable post
        if (!empty($_POST)) {
            //Si tout est bien rentré
            if (!empty($_POST['num']) && !empty($_POST['nom']) && !empty($_POST['prenom'])
                && !empty($_POST['ddn']) && !empty($_POST['taille']) && !empty($_POST['poids'])
                && !empty($_POST['id_poste']) && !empty($_FILES['photo'])
            ) {
                //On sécurise les donnees
                $num = addslashes(htmlentities($_POST['num']));
                $nom = addslashes(htmlentities($_POST['nom']));
                $prenom = addslashes(htmlentities($_POST['prenom']));
                $ddn = addslashes(htmlentities($_POST['ddn']));
                $taille = addslashes(htmlentities($_POST['taille']));
                $poids = addslashes(htmlentities($_POST['poids']));
                $id_poste = addslashes(htmlentities($_POST['id_poste']));

                //Verification du type de la photo
                $allowed_extentions = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!in_array($_FILES['photo']['type'], $allowed_extentions))
                    $error = "La photo doit être de type PNG ou JPG.";

                $max_size = 2000000;
                //Vérification de la taille
                if ($_FILES['photo']['size'] > $max_size)
                    $error = "La photo doit peser moins de 2 Mo.";


                if (empty($error)) {
                    //On upload l'imgage
                    $extention = explode('/', $_FILES['photo']['type']);
                    $photo = 'uploads/photos_joueurs/' . $num . '.' . $extention[1];
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo)) {
                        //On essaye de mettre les donnees dans la db
                        try {
                            $model = $this->model('Mod_Joueurs');
                            $res = $model->insererJoueur($num, $nom, $prenom, $ddn, $taille, $poids, $id_poste, $photo);
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

    public function add_success()
    {
        $this->view('joueurs/add_result');
    }
}