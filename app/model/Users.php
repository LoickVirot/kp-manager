<?php
/**
 * Example of model
 */
class Users extends Database
{

  function __construct()
  {

  }

  //For test
  public function getAllMembers()
  {
    return $this->select("SELECT * FROM users");
  }

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
