<?php
include("../../../inc/config.inc");

if(!is_logged()) {
    header("location:../../login.php");
    die();
}
if(is_user()){
    header("location:'index.php");
die();
}
$titlePage ="Supprimer un client";

$id = $_SESSION["id"];
$sql="DELETE FROM client WHERE id=".$id;
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




