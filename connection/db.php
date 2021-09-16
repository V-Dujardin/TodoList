<?php
include ('conf.php');

global $DB_Host, $DB_Password, $DB_User, $DB_Name;

$pdo = new PDO($DB_Host,$DB_User,$DB_Password);

?>
