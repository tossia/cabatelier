<?php
include("../../inc/config.php");

if(!is_logged()) {
    header("location:../login.php");
    die();
}
$titlePage ="Effacer un utilisateur";

$id = $_SESSION["id"];
$sql="DELETE FROM users WHERE id_user=".$id;
$stmt = $bdd->prepare($sql);
//Add a record about user delete


if(!$stmt->execute()){
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die;
}
 
 header("location:index.php");
 die;
?>




