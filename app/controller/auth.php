<?php

/**
 * Created by PhpStorm.
 * User: marty
 * Date: 09/12/16
 * Time: 13:48
 */
class Auth extends Controller
{
    public function index()
    {
        require_once "../app/core/AuthManager.php";
        if (AuthManager::isUserLogged())
            header('Location:/admin');
        else
            $this->view('auth/login');
    }

    public function login()
    {
        require_once "../app/core/AuthManager.php";
        if (!AuthManager::isUserLogged()) {
            if (!empty($_POST)) {
                if(!empty($_POST['username']) && !empty($_POST['password'])) {
                    //Make input safe
                    $username = addslashes(htmlentities($_POST['username']));

                    //Hash password with salt
                    $salts = require_once '../app/config/salt.php';
                    $password = hash('SHA256', $salts['prefix'].$_POST['password'].$salts['prefix']);
                    echo $password;
                    $db = $this->model('Users');
                    if ($db->canUserLogin($username, $password)) {
                        require_once "../app/core/AuthManager.php";
                        AuthManager::Authenticate($username);
                        header('Location:/admin');
                    }
                    else
                        $this->view('auth/login', ['danger' => 'Nous n\'avons pas réussi a vous connecter. Veuillez  ']);
                }
                else {
                    $this->view('auth/login', ['danger' => 'Vous devez remplir tous les champs.']);
                }
            }
            else
                header('Location:/auth');
        }
        else
            header('Location:/admin');


    }

    /**
     * Logout user
     */
    public function logout() {
        require_once "../app/core/AuthManager.php";
        if (AuthManager::isUserLogged()) {
            AuthManager::logout();
            header('Location:/');
        }
        else {
            header('Location:/auth');
        }
    }
}