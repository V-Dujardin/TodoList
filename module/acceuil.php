<?php
session_start();

global $pdo;

include("../connection/db.php");


if (isset($_SESSION['idUser'])){
if ($_GET['idUser'] == $_SESSION['idUser']) {
$idUser = $_GET['idUser'];
$sql = "SELECT * FROM user WHERE idUser = :idUser";
$statement = $pdo->prepare($sql);
$statement->execute(array('idUser' => $idUser));
$userInfo = $statement->fetch();


if (isset($_POST['lookPage'])) {
    $pseudo = $_POST['friendPseudo'];
    header("Location: module/pageFriend/showTodoFriend.php?idUser=" . $_SESSION['idUser'] . "&pseudo=" . $pseudo);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="../js/ajaxCRUD.js"></script>
    <script src="../js/darkmode.js"></script>
    <link rel="stylesheet" href="../css/darkmode.css">
    <link id="lightCss" rel="stylesheet" href="../css/acceuil/colorlight.css">
    <link rel="stylesheet" href="../css/design.css">
    <link rel="stylesheet" href="../css/buttonDarkMode.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">


    <title>Todo List</title>
</head>
<body>

<!-- MODE SOMBRE-->

<header>
    <br>
        <div class="toggle-btn" id="_1st-toggle-btn">
            <input onchange="changeMode(this.checked);" type="checkbox" name="Mode Sombre">
            <span></span>
        </div>
</header>


<!-- BARRE LATTERALE -->

<div id="laterale" class="cadre">
    <span id="message">Bonjour <?php echo $userInfo['pseudo'] ?> </span>
    <a href="session/deconnexion.php" id="deconnexion">Déconnexion</a>
</div>



<div id="centrale">
    <div class="part cote cadre">
        <h2>Notifications</h2>
        <ul id="notifications"></ul>
    </div>

    <div class="part centre cadre">
        <h2>To Do List</h2>
        <span class="title">Créer vos Todos :</span>
        <div class="ensemble list">
            <form id="newTodo" method="POST">
                <input class="champ" type="text" name="nameTodo" id="nameTodo" placeholder="A faire ..." required/>
                <input class="button" type="submit" id="addListForm" value="Ajouter" required/>
            </form>
        </div>

        <table  valign="top">
            <tr>

                <td>
                    <span class="title">En cours :</span>
                    <ul id="tasksProgress"></ul>
                </td>
                <td>
                    <div class="ensemble">
                        <span class="title">Tâches Finies :</span>
                        <input type="submit" class="button" id="deleteAllTaskCompleted" value="Supprimez toutes les tâches complétés"/>
                    </div>
                    <ul id="tasksCompleted"></ul>
                </td>
            </tr>
        </table>
    </div>

    <!--Partie Amis-->

    <div class="part cote cadre">
        <h2>Liste d'amis</h2>
        <span class="title">Rechercher un ami :</span>
        <input class="champ" type="text" id="searchUser" placeholder="Rechercher des utilisateurs">
        <ul id="user"></ul>

        <span class="title">Amis :</span>
        <ul id="friends"></ul>

        <span class="title">En attente :</span>
        <ul id="waitInvitation"></ul>
    </div>
</div>



</body>

<?php
} else {
    header("Location: acceuil.php?idUser=" . $_SESSION['idUser']);
}
} else {
    header("Location: ../index.php");
}
?>


