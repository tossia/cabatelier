<?php
include("../../../inc/config.php");

if(!is_logged()) {
    header("location:../../index.php");
    die();
}
$titlePage ="Enrégistration d'un fabricant";

$nom = $_POST["nom"];
$nom_pays = $_POST["pays"];
$adresse = $_POST["adresse"];
$contact = $_POST["contact"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$commentaire = $_POST["commentaire"];

$sql = "SELECT * FROM pays WHERE nom_fr_fr='".$nom_pays."'";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$id_pays = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

$sql = "INSERT INTO fabricant (id, nom, pays, adresse, contact_person, email, phone, commentaire) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $bdd->prepare($sql);
$id = $bdd->lastInsertId();

if (!$stmt->execute(array($nom, $id_pays, $adresse, $contact, $email, $phone, $commentaire))) {
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die();
}

header("location:index.php");
die();
