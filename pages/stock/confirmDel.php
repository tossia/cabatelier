<?php
include("../../inc/config.inc");

if(!is_logged()) {
    header("location:../login.php");
    die();
}
$titlePage ="Confirmation d'effacer une article";

$id = $_GET["id"];
$sql = "SELECT reference FROM stock WHERE id=".$id;
$stmt=$bdd->prepare($sql);
$stmt->execute();
$reference = $stmt->fetch(PDO::FETCH_ASSOC);

$message ="";

if ($id) {
    $_SESSION["message"] = $message = "Attention!!"."<br>"."Le reference <b>".$reference['reference']."</b> (ID = ".$id.") sera effacer pour toujours<br />";
    $_SESSION["id"] = $id;
    header("location:index.php");
    die();
}