<?php
session_start();

include("../connection/db.php");

global $pdo;

$user = $_SESSION['pseudo'];

// Savoir si il a des amis

$sql = "SELECT * FROM invitation WHERE (firstUser = :user AND statut = 1 AND blocked = 0) OR (secondUser = :userTwo and statut = 1 AND blocked = 0)";
$statement = $pdo->prepare($sql);
$statement->execute(array('user' => $user, 'userTwo' => $user));
// Tout la liste des amis

if ($statement->rowCount() > 0) {
    while ($row = $statement->fetch()) {
        if ($row['firstUser'] == $user) {
            ?>
            <li><?php echo $row['secondUser'] ?>
                <form method="post">
                    <input class="button" type="submit" id="deleteFriend" value="supprimez" data-id="<?php echo $row['idInvit'] ?>">
                    <input class="button" type="submit" id="lookPage" name="lookPage" value="Voir" data-id="<?php echo $row['secondUser'] ?>">
                    <input class="button" type="submit" id="blocked" value="Bloquer" data-id="<?php echo $row['idInvit'] ?>">
                </form>
            </li>
            <?php
        } else {
            ?>
            <li><?php echo $row['firstUser'] ?>
                <form method="post">
                    <input class="button" type="submit" id="deleteFriend" value="supprimez" data-id="<?php echo $row['idInvit'] ?>">
                    <input class="button" type="submit" id="lookPage" name="lookPage" value="Voir" data-id="<?php echo $row['firstUser'] ?>">
                    <input class="button" type="submit" id="blocked" value="Bloquer" data-id="<?php echo $row['idInvit'] ?>">
                </form>
            </li>
            <?php
        }
        ?><?php

    }
} else { ?>

    <span><?php echo "Ajouter des amis ?" ?></span>

    <?php
}
?>

