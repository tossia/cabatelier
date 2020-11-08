<?php
include("../../inc/config.inc");
if (is_logged()) {
    header("location:index.php");
}


// Check if the post is existed
if (!isset($_POST["login"]) || !isset($_POST["password"])) {
    $_SESSION[$erreur] = "Il y des erreurs";
    header("location:../login.php");
    die();
}

$erreur = false;
// Check if the field of login is fulfilled
if (empty($_POST["login"])) {
    $_SESSION["erreur"][] = "Login est vide";
    $erreur = true;
}

//Check if the field of password is fulfilled
if (empty($_POST["password"])) {
    $_SESSION["erreur"][] = "Mot de passe est vide";
    $erreur = true;
}

// Check if there is a message to send on the login page
if ($erreur) {
    unset($_POST["password"]);
    $_SESSION["post"] = $_POST;
    header('location:../login.php');
    die();
}

// Get the data from the formulaire
$login = htmlspecialchars($_POST["login"]);
$password = htmlspecialchars($_POST["password"]);


// Check if the user exists into the bdd planning

// $sql = "SELECT * FROM planning_user WHERE login=?";
// $stmt = $bdd2->prepare($sql);

$sql = "SELECT * FROM users WHERE login=?";
$stmt = $bdd->prepare($sql);
$stmt->execute(array($login));
$result = $stmt->fetch(PDO::FETCH_ASSOC);


// Check if the login and the password are correct

if ($result) {
 //   if (sha1("¤" . $_POST['password'] . "¤") == $result["password"]) {


if ($result['login'] == $_POST['login']) {
        $_SESSION["user"] = $result;
        $_SESSION["connection"] = true;

        if (!is_admin()) {
            header("location:../../index.php");
        } else {
            header("location:../index.php");
        }
        die();
    } else {
        echo $_SESSION["connection"] = false;
        $_SESSION["erreur"][] = "Mot de pass invalide";
        unset($_POST["password"]);
        $_SESSION["post"] = $_POST;
        header("location:../login.php");
        die();
    }
} else {
    $_SESSION["connection"] = false;
    $_SESSION["erreur"][] = "Login et/ou Mot de passe invalide";
    unset($_POST["password"]);
    $_SESSION["post"] = $_POST;
    header("location:../login.php");
    die();
}


//Add record for connected user 
/*
       $sql_users = "SELECT * FROM users WHERE droit='" . $nom_droit . "'";
        $stmt_droit = $bdd->prepare($sql_droit);
        $stmt_droit->execute();
        $id_droit = $stmt_droit->fetch(PDO::FETCH_ASSOC)['id'];
*/