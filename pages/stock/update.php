<?php

include("../../inc/config.inc");

if (!is_logged()) {
    header("location:index.php");
    die();
}
if (!is_admin()){
    header("location:index.php");
}
$titlePage = "Modification d'un article";

$id = $_POST["id"];
$num_affaire = $_POST["num_affaire"];
$reference = $_POST["reference"];
$designation = $_POST["designation"];
$nom_fabricant = $_POST["fabricant"];
$num_serie = $_POST["num_serie"];
$repere = $_POST["repere"];
$folio = $_POST["folio"];
$saisi_par = $_SESSION["user"]["user_id"];

$sql_affaire = "SELECT * FROM affaire WHERE num_affaire='" . $num_affaire . "'";
$stmt_affaire = $bdd->prepare($sql_affaire);
$stmt_affaire->execute();
$id_affaire = $stmt_affaire->fetch(PDO::FETCH_ASSOC)['id'];

$sql_fabricant = "SELECT * FROM fabricant WHERE nom='" . $nom_fabricant . "'";
$stmt_fabricant = $bdd->prepare($sql_fabricant);
$stmt_fabricant->execute();
$id_fabricant = $stmt_fabricant->fetch(PDO::FETCH_ASSOC)['id'];

$sql_stock = "UPDATE stock SET reference=?, designation=?, id_fabricant=?, num_serie=?, "
        . "id_affaire=?, repere=?, folio=?, saisi_par=?, date_saisi=NOW() "
        . "WHERE id=" . $id;
$stmt_stock = $bdd->prepare($sql_stock);
$stmt_stock->execute(array($reference, $designation, $id_fabricant, $num_serie, $id_affaire, $repere, $folio, $saisi_par));


if (!$stmt_stock->execute(array($reference, $designation, $id_fabricant, $num_serie, $id_affaire, $repere, $folio, $saisi_par))) {
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die();
}

header("location:index.php");
die();
