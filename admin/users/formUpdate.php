<?php
include("../../inc/config.inc");

if (!is_logged()) {
    header("location:index.php");
    die();
}
/*
  if(!is_admin()){
  die("no acces");
  }
  else{
  header("location:fiche.php?id=".$_GET["id"]);
  die();
  }
 */
$titlePage = "Modification utilisateur";


$id_user = $_GET["id_user"];
$sql = "SELECT * FROM users WHERE id_user=" . $id_user;
$stmt = $bdd->prepare($sql);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$droit = "SELECT id_user, nom, droit.droit FROM droit INNER JOIN users ON droit.id = users.droit WHERE id_user=" . $id_user;
$stmt = $bdd->prepare($droit);
$stmt->execute();
$user_droit = $stmt->fetch(PDO::FETCH_ASSOC);

$id_droit = "SELECT droit.droit FROM droit";
$stmt = $bdd->prepare($id_droit);
$stmt->execute();
$list_droit = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'droit');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php
        include("../inc/head.inc");
        ?>
        <title>Mise à jour d'un utilisateur</title>

    </head>

    <body class="bg-gradient-primary">
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <img class="ml-3" id="logoLogin" src='<?php echo SITE_URL; ?>/images/logo.png' alt='logoSPIE' />
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-11 mx-auto">
                            <div class="p-5">
                                <div class="text-center">
                                    <p class="h4 text-gray-900 mb-4"><?php echo $titlePage . " ID = " . $user['id_user']; ?></p>
                                </div>
                                <!-- Formulaire -->
                                <form method="post" action="update.php" class="user" name='form' onsubmit='return validate_pass()'>
                                    <input type="hidden" name="id" value='<?php echo $user["id"]; ?>'>
                                    <input type="hidden" name="id_user" value='<?php echo $user["id_user"]; ?>'>
                                    <div class="form-group d-flex">
                                        <div class="col-6"
                                             <label for='nom'>Nom et prénom</label>
                                            <input type="text" class="form-control form-control-user my-0" value='<?php echo $user["nom"]; ?>' name="nom" id="nom">
                                        </div>
                                        <div class="col-6">
                                            <label for='login'>Login</label>
                                            <input type="text" class="form-control form-control-user my-0" value='<?php echo $user["login"]; ?>' name="login" id="login">
                                        </div>
                                    </div>

                                    <div class="form-group d-flex">

                                        <div class="col-4">
                                            <label for=droit" class="text-danger">Droit accès actuel - <?php echo $user_droit["droit"]; ?></label>
                                            <select name="droit" class="form-control">
                                                <option disabled selected class="text-danger">Si changé, seléctioner pour mettre à jour</option>
                                                <?php
                                                foreach ($list_droit as $droit) {
                                                    if ($droit == $user_droit['droit']):
                                                        echo "<option selected value='" . $droit . "'>" . $droit . "</option>";
                                                    else:
                                                        echo "<option value='" . $droit . "'>" . $droit . "</option>";
                                                    endif;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-8">
                                            <label for='login'>Login</label>
                                            <input type="text" class="form-control form-control-user my-0" value='<?php echo $user["login"]; ?>' name="login" id="login">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col">
                                            <label for='commentaire'>Commentaire</label>
                                            <input type="text" class="form-control form-control-user my-0" value='<?php echo $user["commentaire"]; ?>' name="commentaire" id="commentaire">
                                        </div>
                                    </div>
                                    <input type="submit" value="Mettre à jour" class="btn btn-primary btn-user btn-block">
                                </form>
                                <hr>
                                <a class="small btn btn-warning btn-user btn-block text-dark" href="index.php">Retourner sur la liste des utilisateurs. <b>Les changements ne seront pas enrégistrés</b></a>
                                <!-- fin p-5 -->
                            </div>
                            <!--fin col-9  -->
                        </div>
                        <!--fin row -->
                    </div>
                    <!-- Fin card body-->
                </div>
                <!--Card hidden -->
            </div>
            <!-- Fin de container -->
        </div>

        <!-- Bootstrap core JavaScript Core plugin JavaScript Custom scripts for all pages-->
        <?php
        include("../inc/bottom.inc");
        ?>
    </body>
</html>