<?php
session_start();

include("../connection/db.php");

global $pdo;

$idInvit = $_POST['idInvit'];

$sql = "UPDATE invitation SET statut = 1 WHERE idInvit = :idInvit";
$statement = $pdo->prepare($sql);
$statement->execute(array('idInvit' => $idInvit));

header("Location: ../module/acceuil.php?idUser=" . $_SESSION['idUser']);
