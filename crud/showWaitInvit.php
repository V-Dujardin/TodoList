<?php
session_start();

include("../connection/db.php");

global $pdo;

$user = $_SESSION['pseudo'];

// Savoir si il a des amis

$sql = "SELECT * FROM invitation WHERE firstUser = :user AND statut = 0";
$statement = $pdo->prepare($sql);
$statement->execute(array('user' => $user));
// Tout la liste des amis

if ($statement->rowCount() > 0) {
    while ($row = $statement->fetch()) {
        if ($row['firstUser'] == $user) {
            ?>
            <li><?php echo $row['secondUser'] ?>
                <input type="submit" class="button" id="deleteFriend" value="supprimez" data-id="<?php echo $row['idInvit'] ?>">
            </li>
            <?php
        } else {
            ?>
            <li><?php echo $row['firstUser'] ?>
                <input type="submit" class="button" id="deleteFriend" value="supprimez" data-id="<?php echo $row['idInvit'] ?>">
            </li>
            <?php
        }
        ?><?php

    }
} else { ?>

    <span><?php echo "Aucune notification" ?></span>

    <?php
}
?>

