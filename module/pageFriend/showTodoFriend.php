<?php
session_start();

include("../../connection/db.php");

global $pdo;

$idFriend = $_POST['idInvit'];




?>

!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <title>Page d'un ami</title>
</head>
<body>

<h3>Page des bloqué</h3>
<div>
    <ul id="banned"></ul>
</div>

</body>
