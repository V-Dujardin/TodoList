<?php
session_start();

include ("../connection/db.php") ;

global $pdo;

$idUser = $_SESSION['idUser'];

$sql = "SELECT * FROM list WHERE idUser = :idUser AND etat = 0 ORDER BY idTodo DESC ";
$statement = $pdo -> prepare($sql);
$result = $statement -> execute(array('idUser' => $idUser));

if($statement->rowCount() > 0){
    while($row = $statement->fetch()){
        ?>
        <li>
            <span ><?php echo $row['nameTodo']?></span>
            <input class="button" data-id="<?php echo $row['idTodo']?>" type="submit" id="removeTodo" value="Supprimez"/>
        </li>
        <?php
    }
} else { ?>
    <span><?php echo "Aucune tâches complétés :( Vous êtes y presque ! "?></span>
    <?php
}

?>
