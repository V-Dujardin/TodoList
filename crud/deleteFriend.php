<?php
session_start();

include("../connection/db.php");

global $pdo;

$idInvitation = $_POST['idInvit'];

$sql = "DELETE FROM invitation WHERE idInvit = :idinvt";
$sta = $pdo ->prepare($sql);
$result = $sta->execute(array('idinvt' => $idInvitation));


header("Location: ../module/acceuil.php?idUser=" . $_SESSION['idUser']);