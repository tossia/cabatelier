<?php

include('../../../inc/config.inc');

  if (!is_logged()) {
  header("location:../index.php");
  die();
  }
  
$id = $_POST["id"];
$client = $_POST["client"];
$nom_pays = $_POST["pays"];
$adresse = $_POST["adresse"];
$contact = $_POST["contact"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$comments = $_POST["commentaire"];

$sql = "SELECT * FROM pays WHERE nom_fr_fr='".$nom_pays."'";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$id_pays = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

$sql = "UPDATE client SET client=?, pays=?, adresse=?, contact_person=?, email=?, phone=?, commentaire=? "
        ."WHERE id=".$id;
$stmt = $bdd->prepare($sql);
$stmt->execute(array($client, $id_pays, $adresse, $contact, $email, $phone, $comments));

if (!$stmt->execute(array($client, $id_pays, $adresse, $contact, $email, $phone, $comments))) {
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die();
}

header("location:index.php");
die();

