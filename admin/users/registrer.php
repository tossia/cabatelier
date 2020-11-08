<?php
include("../../inc/config.inc");

if (!is_logged()) {
    header("location:index.php");
    die();
}
if (!is_admin()) {
    header("location:../index.php");
    die();
}
$titlePage = "Registrer un nouveau utilisateur";

$all_droit = "SELECT droit FROM droit";
$stmt_droit = $bdd->prepare($all_droit);
$stmt_droit->execute();
$list_droit = array_column($stmt_droit->fetchAll(PDO::FETCH_ASSOC), 'droit');
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <title>Ajouter utilisateur</title>
        <?php
        include("../inc/head.inc");
        ?>
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
                                    <p class="h4 text-gray-900 mb-4"><?php echo $titlePage; ?></p>
                                </div>

                                <!-- Formulaire -->
                                <form method="post" action="firstReg.php" class="user" name='form' onsubmit='return validate_pass()'>
                                    <div class="col-3">
                                        <lable for="id_user">ID RH</lable>
                                        <input type="text" class="form-control form-control-user" value="" name="id_user" id="id" placeholder="ID personel">
                                    </div>

                                    <div class="form-group d-flex">
                                        <div class="col-6">
                                            <label for="nom">Nom et prénom</label>
                                            <input type="text" class="form-control form-control-user" name="nom" id="nom" placeholder="Nom">
                                        </div>
                                        <div class="col-6">
                                            <label for="login">Login</label>
                                            <input type="text" class="form-control form-control-user" name="login" id="login" placeholder="Login">
                                        </div>
                                    </div>

                                    <div class="form-group d-flex">
                                     
                                        <div class="col-6">
                                            <label for=droit">Droit accès</label>
                                            <select name="droit" class="form-control">
                                                <option class="form-control form-control-user" disabled selected>Choisir les droits d'accès</option>
                                                <?php
                                                foreach ($list_droit as $droit) {
                                                    echo "<option value=" . $droit . ">" . $droit . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Commentaires</label>
                                        <input type="text" class="form-control" name="commentaire" id="comment" placeholder="Ajouter des commentaires">
                                    </div>
                                    <input type="submit" value="Enrégistrer" class="btn btn-primary btn-user btn-block font-weight-bold">
                                </form>
                                <hr>
                                <a class="small btn btn-info btn-user btn-block text-dark" href="index.php">Retourner sur la liste des utilisateurs. <b>Cet utilisateur ne sera pas enrégistré</b></a>
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