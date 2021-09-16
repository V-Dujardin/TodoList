<?php

session_start();

include("../connection/db.php");

global $pdo;

$idTodo = $_POST['valueId'];

$sql = "DELETE FROM list WHERE idTodo = :idTodo";
$statement = $pdo->prepare($sql);
$result = $statement->execute(array('idTodo'=>$idTodo));

if($result){
    echo 1;
} else {
    echo 0;
}
