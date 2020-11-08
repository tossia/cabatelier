<?php
include("../../inc/config.php");


if(!is_logged()) {
    header("location:../login.php");
    die();
}

$titlePage ="Confirmation de effacer une page";

$id = $_GET["id"];
$message ="";

if ($id) {
    $_SESSION["message"] = $message = "L'utilsateur avec ID = ".$id." sera effacer pour toujours<br />";
    $_SESSION["id"] = $id;
    header("location:index.php");
    die();
}