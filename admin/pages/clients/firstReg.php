<?php
include("../../../inc/config.inc");

if(!is_logged()) {
    header("location:../../index.php");
    die();
}
$titlePage ="Registration une client";

$client = $_POST['client'];
$nom_pays = $_POST['pays'];
$adresse = $_POST['adresse'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$commentaire = $_POST["commentaire"];

$sql = "SELECT * FROM pays WHERE nom_fr_fr='".$nom_pays."'";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$id_pays = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

$sql = "INSERT INTO client (id, client, pays, adresse, contact_person, email, phone, commentaire) "
        ."VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $bdd->prepare($sql);
$id = $bdd->lastInsertId();

if (!$stmt->execute(array($client, $id_pays, $adresse, $contact, $email, $phone, $commentaire))) {
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die();
}

header("location:index.php");
die();
