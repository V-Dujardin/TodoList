<?php
session_start();

include("../connection/db.php");

global $pdo;

$user = $_SESSION['pseudo'];

// Savoir si il a des amis

$sql = "SELECT * FROM invitation WHERE secondUser = :user AND statut = 0";
$statement = $pdo->prepare($sql);
$statement->execute(array('user' => $user));
// Tout la liste des amis

if ($statement->rowCount() > 0) {
    while ($row = $statement->fetch()) {
        if ($row['firstUser'] == $user) {
            ?>
            <div class="ensemble">
                <li><?php echo $row['secondUser'] ?> vous suit.</li>
                <input type="submit" class="button" id="acceptFriend" value="accepter" data-id="<?php echo $row['idInvit'] ?>">
                <input type="submit" class="button" id="deleteFriend" value="refuser" data-id="<?php echo $row['idInvit'] ?>">
            </div>
            <?php
        } else {
            ?>
                <div class="ensemble">
            <li><?php echo $row['firstUser'] ?> vous suit.</li>
                <input type="submit" class="button" id="acceptFriend" value="accepter" data-id="<?php echo $row['idInvit'] ?>">
                <input type="submit" class="button" id="deleteFriend" value="refuser" data-id="<?php echo $row['idInvit'] ?>">
            </div>
            <?php
        }
        ?><?php

    }
} else { ?>

    <span><?php echo "Aucune notification" ?></span>

    <?php
}
?>

