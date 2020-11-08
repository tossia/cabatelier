<?php
include("../../../inc/config.inc");

if(!is_logged()) {
    header("location:../../index.php");
    die();
}
$titlePage ="Enrégistration d'un article";

$num_affaire = $_POST["num_affaire"];
$reference = $_POST["reference"];
$designantion = $_POST["designantion"];
$nom_fabricant = $_POST["fabricant"];
$num_serie = $_POST["num_serie"];
$localisation = $_POST["localisation"];
$repere = $_POST["repere"];
$folio = $_POST["folio"];
$saisi_par = $_SESSION["user"]["id_user"];
$date_saisi = $_POST["date_saisi"];


$sql_fabricant = "SELECT * FROM fabricant WHERE nom='".$nom_fabricant."'";
$stmt_fabricant = $bdd->prepare($sql_fabricant);
$stmt_fabricant->execute();
$id_fabricant = $stmt_fabricant->fetch(PDO::FETCH_ASSOC)['id'];

$sql_affaire = "SELECT * FROM affaire WHERE num_affaire='".$num_affaire."'";
$stmt_affaire = $bdd->prepare($sql_affaire);
$stmt_affaire->execute();
$id_affaire = $stmt_affaire->fetch(PDO::FETCH_ASSOC)['id'];

$sql_loco = "SELECT * FROM localisation WHERE nom='".$localisation."'";
$stmt_loco = $bdd->prepare($sql_loco);
$stmt_loco->execute();
$id_loco = $stmt_loco->fetch(PDO::FETCH_ASSOC)['id'];

$sql_repere = "SELECT * FROM repere WHERE nom='".$repere."'";
$stmt_repere = $bdd->prepare($sql_repere);
$stmt_repere->execute();
$id_repere = $stmt_repere->fetch(PDO::FETCH_ASSOC)['id'];

$sql_folio = "SELECT * FROM folio WHERE numero='" . $folio . "'";
$stmt_folio = $bdd->prepare($sql_folio);
$stmt_folio->execute();
$num_folio = $stmt_folio->fetch(PDO::FETCH_ASSOC)['id'];

$sql_stock = "INSERT INTO stock (id, reference, designantion, id_fabricant, num_serie, "
        ."id_affaire, id_localisation, id_repere, id_folio, saisi_par, date_saisi) "
        . "VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
$stmt_stock = $bdd->prepare($sql_stock);
$stmt_stock->execute(array($reference, $designantion, $id_fabricant, $num_serie, $id_affaire, $id_loco, $id_repere, $num_folio, $saisi_par));

$id = $bdd->lastInsertId();



if (!$stmt_stock->execute(array($reference, $designantion, $id_fabricant, $num_serie, $id_affaire, $id_loco, $id_repere, $num_folio, $saisi_par))) {
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt_stock->errorInfo());
    die();
}

header("location:index.php");
die();