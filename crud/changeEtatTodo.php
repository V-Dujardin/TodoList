<?php

session_start();

include("../connection/db.php");

global $pdo;


$idTodo = $_POST['valueId'];
$idUser = $_SESSION['idUser'];
$etat = 0;

$sql = "UPDATE list SET etat = 0 WHERE idUser = :idUser AND idTodo = :idTodo";
$statement = $pdo -> prepare($sql);
$result = $statement->execute(array('idUser' => $idUser, 'idTodo' => $idTodo));

if($result){
    echo 1;
} else {
    echo 0;}

