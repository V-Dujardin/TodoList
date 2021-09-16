<?php
session_start();

include("connection/db.php");

global $pdo;


if (isset($_POST['formlogin'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {

        $sql = "SELECT * FROM user WHERE pseudo = :pseudo AND password = :password ";

        $statement = $pdo->prepare($sql);

        $statement->execute(
            array(
                'pseudo' => $pseudo,
                'password' => $password
            )
        );

        if ($statement->rowCount() == 1) {
            $userInfo = $statement->fetch();
            $_SESSION['idUser'] = $userInfo['idUser'];
            $_SESSION['pseudo'] = $userInfo['pseudo'];
            $_SESSION['password'] = $userInfo['password'];
            header("Location: module/acceuil.php?idUser=" . $_SESSION['idUser']);

            setcookie('connection', true, time() + 10000);
        } else {
            $erreur = "Mauvais login ou mot de passe";
        }
    } else {
        $erreur = "Merci de remplir les deux champs";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index/style.css">
    <title>Todo List</title>
</head>
<body>


<a href="../dashboard/index.html">Retour menu</a> <br>

<div id="StyleFormLogin">
    <div id="formContainer">
        <form method="post">
            <h3>Connection</h3>
            <input type="text" name="pseudo" placeholder="Pseudo"/>
            <input type="password" name="password" placeholder="Mot de passe"/>
            <input id="buttonLogin" type="submit" name="formlogin" value="Se connecter"/>
            <a href="module/session/register.php">Créer un compte ?</a>
        </form>
    </div>


    <?php
    if (isset($erreur)) {
        echo "<script type='text/javascript'>alert('$erreur');</script>";
    }
    ?>

</div>

<br>


</body>
