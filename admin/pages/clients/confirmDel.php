<?php
include("../../../inc/config.inc");

if(!is_logged()) {
    header("location:../../login.php");
    die();
}
$titlePage ="Confirmation d'effacer un client";

$id = $_GET["id"];
$sql = "SELECT * FROM client WHERE id=".$id;
$stmt=$bdd->prepare($sql);
$stmt->execute();
$nom = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'client');

$message ="";


if ($id) {
    $_SESSION["message"] = $message = "Attention! ID =".$id." Client : '".$nom[0]."' sera supprimer pour toujours<br />";
    $_SESSION["id"] = $id;
    header("location:index.php");
    die();
}