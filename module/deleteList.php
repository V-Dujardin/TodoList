<?php

include("../connection/db.php");

if(isset($_GET['idTodo'])){
    $idTodo = $_GET['idTodo'];
    deleteTodo($idTodo);
    header("Location:acceuil.php?idUser=" . $_SESSION['idUser']);
}