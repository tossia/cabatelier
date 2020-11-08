<?php
include("../../inc/config.inc");

if(!is_logged()) {
    header("location:../../index.php");
    die();
}
$titlePage = "Modification d'un article";

$id = $_POST["id"];
$num_affaire = $_SESSION["num_affaire_initial"];
//$repere = $_POST["repere"];
$nom_place = $_POST["emplacement"];
$num_serie = $_POST['num_serie'];
$saisi_par = $_SESSION["user"]["user_id"];

$sql_emplacement = "SELECT * FROM emplacement WHERE titre_emplacement='".$nom_place."'";
$stmt_emplacement = $bdd->prepare($sql_emplacement);
$stmt_emplacement->execute();
$id_emplacement = $stmt_emplacement->fetch(PDO::FETCH_ASSOC)['id'];

$sql_user = "SELECT * FROM users WHERE nom='".$_SESSION['user']['nom']."'";
$stmt_user = $bdd->prepare($sql_user);
$stmt_user->execute();
$id_user = $stmt_user->fetch(PDO::FETCH_ASSOC)['id'];

$sql_stock = "UPDATE stock SET id_emplacement=?, num_serie=?, saisi_par=?, date_saisi=NOW() "
        . "WHERE id=" . $id;

$stmt_stock = $bdd->prepare($sql_stock);
$stmt_stock->execute(array($id_emplacement, $num_serie, $saisi_par));


if (!$stmt_stock->execute(array($id_emplacement, $num_serie, $saisi_par))) {
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die();
}

header("location:index.php");
die();
