<?php
include("../../../inc/config.inc");

if (!is_logged()) {
    header("location:../../index.php");
    die();
}
$titlePage = "Enrégistration d'un numéro d'affaire";


$num_affaire = $_POST["num_affaire"];
$titre_affaire = $_POST["titre_affaire"];
$nom_client = $_POST["client"];


if ($_POST["pays"] = 'Seléctioner un pays'):
    $nom_pays = NULL;
else:
    $nom_pays = $_POST["pays"];
endif;
if (!empty($date_debut = $_POST["date_debut"])):
    $date_debut = $_POST["date_debut"];
else:
    ($date_debut = NULL);
endif;
if (!empty($_POST["status_affaire"])):
    $nom_status = $_POST["status_affaire"];
else:
    $nom_status = NULL;
endif;
if (!empty($_POST["date_fin"])):
    $date_fin = $_POST["date_fin"];
else:
    $date_fin = NULL;
endif;
$commentaire = $_POST["commentaire"];


// Transform the names (pays, client and status) on index
$sql_pays = "SELECT * FROM pays WHERE nom_fr_fr='".$nom_pays."'";
$stmt_pays = $bdd->prepare($sql_pays);
$stmt_pays->execute();
$id_pays = $stmt_pays->fetch(PDO::FETCH_ASSOC)['id'];

$sql_client = "SELECT * FROM client WHERE client='".$nom_client."'";
$stmt_client = $bdd->prepare($sql_client);
$stmt_client->execute();
$id_client = $stmt_client->fetch(PDO::FETCH_ASSOC)['id'];

$sql_status = "SELECT * FROM status_affaire WHERE status='".$nom_status."'";
$stmt_status = $bdd->prepare($sql_status);
$stmt_status->execute();
$id_status = $stmt_status->fetch(PDO::FETCH_ASSOC)['id'];


$sql = "INSERT INTO affaire (id, num_affaire, titre_affaire, id_client, pays_livraison, date_debut, id_status, date_fin, commentaire) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $bdd->prepare($sql);
$id = $bdd->lastInsertId();

if (!$stmt->execute(array($num_affaire, $titre_affaire, $id_client, $id_pays, $date_debut, $id_status, $date_fin, $commentaire))) {
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die();
}
header("location:index.php");
die();
