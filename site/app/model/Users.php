<?php
/**
 * Example of model
 */
class Users extends Database
{

  /**
   * Check if user can login
   * @return boolean
   */
    public function canUserlogin($username, $password) {
      $res = $this->count("SELECT count(username) FROM users WHERE username='$username' AND password='$password';");
      return $res == 1;
    }
}
 ?>
