<?php

/**
 * Manage auth system
 * User: marty
 * Date: 13/12/16
 * Time: 08:18
 */
class AuthManager
{

    public function __construct()
    {

    }

    /**
     * Check if user is logged
     * @return bool
     */
    public static function isUserLogged() {
        return !empty($_SESSION['username']);
    }

    /**
     * Change user login state
     */
    public static function Authenticate($username) {
        $_SESSION['username'] = $username;
    }

    public static function logout()
    {
        session_destroy();
    }

}