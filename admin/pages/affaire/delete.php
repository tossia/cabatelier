<?php
include("../../../inc/config.inc");

if(!is_logged()) {
    header("location:../../login.php");
    die();
}
if(!is_admin()){
    header("location:'../../index.php");
die();
}

$titlePage ="Supprimer un numéro d'affaire";

$id = $_SESSION["id"];
$sql="DELETE FROM affaire WHERE id=".$id;
$stmt = $bdd->prepare($sql);

if(!$stmt->execute()){
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die;
}
 
 header("location:index.php");
 die;
?>




