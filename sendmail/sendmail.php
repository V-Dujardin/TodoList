<?php
session_start();

global $pdo;

include("../connection/db.php");

$user = $_SESSION['pseudo']; // Utilisateur
$email = $_POST['email']; // Email de la personne à invite
$pseudoToInvite = $_POST['pseudo'];
$chooseWrite = $_POST['chooseWrite'];


$choseWrite = true; // !!!!!!!!! A définir !!!!!!!



$sqlInvite = "SELECT statut FROM invitation WHERE firstUser = :user AND secondUser = :pseudoToInvite AND statut = 1 OR firstUser = :pseudoToInvite  AND secondUser = :user AND statut = 1";
$statementInvite = $pdo -> prepare($sqlInvite);
$resultInvite = $statementInvite->execute(array('user' => $user, 'pseudoToInvite' => $pseudoToInvite));
$result = $statementInvite->fetch();

// Resultat de l'opération
$result = $result[0];

// Si $statementInvite est vide alors l'invite n'existe pas
// Si il n'y a pas d'invite alors on peut en créer une une

if($result == ""){

    // Créer un l'invitation

    $sql = "INSERT INTO invitation (firstUser, secondUser, statut, accesWrite, blocked) VALUE (:user, :pseudo,  0, :chooseWrite, 0)";
    $statement = $pdo -> prepare($sql);
    $result = $statement -> execute(array(
        'user' => $user,
        'pseudo' => $pseudoToInvite,
        'chooseWrite' => $chooseWrite
    ));

    echo "Invitation créer";

    // Formulaire pour envoyer le mail
    $header = "MIME-Version: 1.0\r\n";
    $header.= 'From:"TodoList.com"'."\n";
    $header.= 'Content-Type:text/html; charset="utf-8"'."\n";
    $header.= 'Content-Transfer-Encoding: 8bit';

    $message= '
        <html lang="fr">
            <body>
                <h3>Bonjour '.$pseudoToInvite.' !</h3>
                <div>
                    '.$user.' viens de vous envoyé une demande d\'ami sur Todo List !
                </div>
            </body>
        </html>';


    // Envoie du mail
    mail($email,"Invitation sur Todo List",$message,$header);

    // Redirection
    header("Location: ../module/acceuil.php?idUser=" . $_SESSION['idUser']);

} else {

    header("Location: ../module/acceuil.php?idUser=" . $_SESSION['idUser']);
}


