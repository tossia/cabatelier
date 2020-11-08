<?php
include("../../../inc/config.inc");

if(!is_logged()) {
    header("location:../../login.php");
    die();
}

if(!is_admin()) {
    header("location:../../index.php");
}
$titlePage ="Confirmation de supression d'un numéro d'affaire";

$id = $_GET["id"];

$sql = "SELECT * FROM affaire WHERE id=".$id;
$stmt=$bdd->prepare($sql);
$stmt->execute();
$nom = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'num_affaire');
$message ="";

if ($id) {
    $_SESSION["message"] = "Le numéro d'affaire ".$nom[0]." (ID=".$id.") sera effacer pour toujours<br />";
    $_SESSION["id"] = $id;
    header("location:index.php");
    die();
}