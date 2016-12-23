<?php

/**
* Connection to the database
*/
class Database
{
	private static $db;

	function __construct()
	{
	    if (empty(self::$db)) {
            try {
                $access = require_once '../app/config/database.php';
                self::$db = new PDO("mysql:host=".$access['host'].";dbname=".$access['database'].";charset=".$access['charset']."", $access['user'], $access['password']);
            }
            catch (PDOException $e) {
                echo "<pre>Can't connect to Database.<br/><b>Message : </b>".$e->getMessage()."</pre>";
            }
        }
	}

    /**
     * Execute select request
     * @param string $request Request to send to the database
     *
     * @return array
     */
	public function select($request)
	{
		$prep = self::$db->prepare($request);
		$prep->execute();
		return $prep->fetch();
	}

    /**
     * Execute count request
     * @param string $request Request to send to the database
     *
     * @return integer
     */
	public function count($request)
	{
		return self::$db->query($request)->fetchColumn();
	}

    /**
     * Execute insert request
     * @param string $request Request to send to the database
     *
     * @return bool
     */
	public function insert($request)
	{
		$prep = self::$db->prepare($request);
		$verif = $prep->execute();
		return $verif;
	}
}


?>
