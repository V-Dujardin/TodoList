<?php
session_start();

include("../connection/db.php");

global $pdo;

$addTodo = $_POST["addTodo"];
$idUser = $_SESSION['idUser'];
$etat = 1;

$sql = "INSERT INTO list (nameTodo, etat, idUser) VALUE (:nameTodo, :etat,:idUser)";
$statement = $pdo -> prepare($sql);
$result = $statement -> execute(array(
        'nameTodo' => $addTodo,
        'etat' => $etat,
        'idUser' => $idUser
));


if($result){
    echo 1;
} else {
    echo 0;
}







