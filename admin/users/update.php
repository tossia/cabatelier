<?php

include('../../inc/config.inc');

  if (!is_logged()) {
  header("location:../index.php");
  die();
  }
  
  if (is_user()):
      header("location:../../../index.php");
  endif;

$id = $_POST["id"];
$id_user = $_POST["id_user"];
$nom = $_POST["nom"];
$login = $_POST["login"];
$droit = $_POST["droit"];
$comments = $_POST["commentaire"];

$sql_droit = "SELECT * FROM droit WHERE droit='".$droit."'";
$stmt_droit = $bdd->prepare($sql_droit);
$stmt_droit->execute();
$id_droit = $stmt_droit->fetch(PDO::FETCH_ASSOC)['id'];


$sql = "UPDATE users SET id_user=?, nom=?, login=?, droit=?, commentaire=? WHERE id=" . $id;
$stmt = $bdd->prepare($sql);
$stmt->execute(array($id_user, $nom, $login, $id_droit, $comments));

//Add record for user update

if (!$stmt->execute(array($id_user, $nom, $login, $id_droit, $comments))) {
    echo "<p>Erreur SQL</p>";
    echo $sql;
    print_r($stmt->errorInfo());
    die();
}

header("location:index.php");
die();