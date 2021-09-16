<?php

session_start();

include("../connection/db.php");

global $pdo;

$idUser = $_SESSION['idUser'];
$etat = 0;

$sql = "DELETE FROM list WHERE idUser = :idUser";
$statement = $pdo -> prepare($sql);
$result = $statement->execute(array('idUser' => $idUser));

if($result){
    echo 1;
} else {
    echo 0;}


