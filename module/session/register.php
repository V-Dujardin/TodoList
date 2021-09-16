<?php

include("../../connection/db.php");

if (isset($_POST['submit'])) {
    if (!empty($_POST['pseudo']) and !empty($_POST['password']) and !empty($_POST['email'])) {
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        global $pdo;
        $sql = "SELECT * FROM user WHERE pseudo = :pseudo";
        $statement = $pdo->prepare($sql);
        $statement->execute(array('pseudo' => $pseudo));

        $sqlB = "SELECT * FROM user WHERE email = :email";
        $statementB = $pdo->prepare($sqlB);
        $statementB->execute(array('email' => $email));

        if ($statement->rowCount() != 1) {
            if ($statementB->rowCount() != 1) {
                createUser($pseudo, $email, $password);
                header("Location: ../../index.php");

            } else {
                $erreur = "Adresse mail déjà prise !";
            }

        } else {
            $erreur = "Pseudo déjà pris !";
        }
    } else {
        $erreur = "Merci de remplir le formulaire";
    }

}

?>

<?php

function createUser($pseudo, $email, $password)
{
    global $pdo;
    $sql = "INSERT INTO user (pseudo , email, password) VALUE (:pseudo, :email , :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        array(
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $password
        )
    );
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/index/style.css">
    <title>Todo List</title>
</head>
<body>

<div id="StyleFormLogin">
        <div id="formContainer">
            <form action="" method="post">
                <h3>Inscription</h3>
                <input type="text" name="pseudo" placeholder="Pseudo"/>
                <input type="email" name="email" placeholder="Adresse mail"/>
                <input type="password" name="password" placeholder="Mot de passe"/>
                <input id="buttonLogin" type="submit" name="submit" value="Inscription"/>
                <a href="../../index.php">Se connecter</a>
            </form>
        </div>
    </form>
</div>

<?php
if (isset($erreur)) {
    echo "<script type='text/javascript'>alert('$erreur');</script>";
}
?>

</body>