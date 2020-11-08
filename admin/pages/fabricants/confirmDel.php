<?php
include("../../../inc/config.inc");

if(!is_logged()) {
    header("location:../../login.php");
    die();
}
$titlePage ="Confirmation du supression d'un fabricant";

$id = $_GET["id"];

$sql = "SELECT * FROM fabricant WHERE id=".$id;
$stmt=$bdd->prepare($sql);
$stmt->execute();
$nom = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'nom');

$message ="";

if ($id) {
    $_SESSION["message"] = $message = "Attention! Fabricant ".$nom[0]." (ID = ".$id.") sera supprimé pour toujours<br />";
    $_SESSION["id"] = $id;
    header("location:index.php");
    die();
}