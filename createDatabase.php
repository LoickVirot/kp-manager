<?php
/**
 * User: Loick
 * Date: 15/12/16
 * Time: 10:27
 */
// Connect to the DB

try {
    $access = require_once 'app/config/database.php';
    $db = new PDO("mysql:host=".$access['host'].";dbname=".$access['database'].";charset=".$access['charset']."", $access['user'], $access['password']);
}
catch (PDOException $e) {
    echo "<pre>Can't connect to Database.<br/><b>Message : </b>".$e->getMessage()."</pre>";
}

$res = $db->query('
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(32) NOT NULL,
`password` varchar(256) NOT NULL,
`mail` varchar(128) NOT NULL,
PRIMARY KEY (id)
);');

if (!$res) {
    echo "Error while creating table 'users'.\n";
}

?>