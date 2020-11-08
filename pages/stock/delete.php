<?php
include("../../inc/config.inc");

if(!is_logged()) {
    header("location:login.php");
    die();
}
$titlePage ="Supprimer une article";

$id = $_SESSION["id"];
$sql="DELETE FROM stock WHERE id=".$id;
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




