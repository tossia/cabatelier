<?php

include("../../inc/config.php");

if (!is_logged()) {
    header("location:index.php");
    die();
}
$titlePage = "Registrer un utilisateur";

$id_user = $_POST["id_user"];
$nom = $_POST["nom"];
$login = $_POST["login"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$nom_metier = $_POST["metier"];
$nom_droit = $_POST["droit"];
$comments = $_POST["commentaire"];


$sql_metier = "SELECT * FROM metier WHERE metier='" . $nom_metier . "'";
$stmt_metier = $bdd->prepare($sql_metier);
$stmt_metier->execute();
$id_metier = $stmt_metier->fetch(PDO::FETCH_ASSOC)['id'];

$sql_droit = "SELECT * FROM droit WHERE droit='" . $nom_droit . "'";
$stmt_droit = $bdd->prepare($sql_droit);
$stmt_droit->execute();
$id_droit = $stmt_droit->fetch(PDO::FETCH_ASSOC)['id'];


$sql = "INSERT INTO users (id, id_user, nom, login, password, email, mobile, metier, droit, commentaire) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $bdd->prepare($sql);
$id = $bdd->lastInsertId();
//Add record for user creation



echo $id;
if (!$stmt->execute(array($id_user, $nom, $login, $password, $email, $mobile, $id_metier, $id_droit, $comments))) {
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die();
}
header("location:index.php");
die();
