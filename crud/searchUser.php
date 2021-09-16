<?php

session_start();

include("../connection/db.php");

global $pdo;

$userName = $_SESSION['pseudo'];

$user = $_POST['user'];

$sql = "SELECT * FROM user WHERE pseudo OR email LIKE ? LIMIT 10";
$statement = $pdo->prepare($sql);
$statement->execute(array("$user%"));
$result = $statement->fetchAll();


// Verifie si la demande existe ou pas
function check($user, $second)
{
    global $pdo;

    $sqlExistFriend = "SELECT * FROM invitation WHERE firstUser = :user AND secondUser = :second OR firstUser = :second AND secondUser = :user";


    $sql = "SELECT statut FROM invitation WHERE firstUser = :user AND secondUser = :inviteUser AND statut = 1 AND blocked = 0 OR firstUser = :inviteUser AND secondUser = :user AND statut = 1 AND blocked = 0";

    $statement = $pdo->prepare($sql);
    $sta = $pdo->prepare($sqlExistFriend);
    $sta->execute(array('user' => $user, 'second' => $second));
    $statement->execute(array('user' => $user, 'inviteUser' => $second));
    $statement->fetch();
    $alreadyFriend = $sta->fetch();

    if($alreadyFriend == ""){
        return true;
    } else {
        return false;
    }

}



foreach ($result as $row) {

    if(check($userName, $row['pseudo']) and $row['pseudo'] != $userName){
        ?>

        <li>
            <span>Email : <?php echo $row['email'] ?></span> <br>
            <span> Pseudo : <?php echo $row['pseudo'] ?></span>
            <br>
            <label for="chooseWrite">Pourvoir modifier vos TodoList :</label>
            <select name="chooseWrite" id="chooseWrite">
                <option value="false">Non</option>
                <option value="true">Oui</option>
            </select>

            <input class="button" type="submit" id="sendMail" data-email="<?php echo $row['email'] ?>"
                   data-pseudo="<?php echo $row['pseudo'] ?>" value="Suivre"/>
        </li>
        <?php

    }

}

?>
