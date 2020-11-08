<?php
include("../../../inc/config.inc");

if (!is_logged()) {
    header("location:../../index.php");
    die();
}
if (is_user()) {
    header("location:../../../index.php");
    die();
}

include("../../inc/select_for_num_affaire.inc");
$titlePage = "Enregistrer un nouveau numéro d'affaire";
?>


<!DOCTYPE html>
<html lang="fr">

    <head>
        <?php
        include("../../inc/head.inc");
        ?>
        <title><?php $titlePage; ?></title>
        <script>
            function verif_vide() {
                let num_affaire = document.forms["form"]["num_affaire"].value;
                let client = document.forms["form"]["client"].value;
                //check if numero d'affaire & client are fulfilled
                if (num_affaire.length == 0 || client.length == 0) {
                    document.getElementById("alert").innerHTML = "Numéro d'affaire et le client doivent être saisi";
                    return false;
                }
            }
        </script>
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
                                    <h4 class="text-gray-900 mb-4"><?php echo $titlePage; ?></h4>
                                </div>
                                <!-- Formulaire -->
                                <span style="color:red" id="alert"></span>
                                <form method="post" action="firstReg.php" class="user" name='form' onsubmit='return verif_vide()'>
                                    <div class="form-group d-flex">
                                        <div class="col-6">
                                            <label for='num_affaire'>Numéro d'affaire</label>
                                            <input type="text" class="form-control form-control-user" name="num_affaire" id="titre" placeholder="Saisir le numéro d'affaire" value="">                                            
                                        </div>
                                        <div class='col-6'>
                                            <label for='titre_affaire'>Titre affaire</label> 
                                            <input type="text" class="form-control form-control-user" name="titre_affaire" id="titre_affaire">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class='col-6'>
                                            <label for="client">Client</label>
                                            <select name="client" class="form-control">
                                                <option selected value="">Seléctioner votre client</option>
                                                <?php
                                                foreach ($list_client as $client) {
                                                    echo "<option value='" . $client . "'>" . $client . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class='col-6'>
                                            <label for="pays">Pays de livraison</label>
                                            <select name="pays" class="form-control">
                                                <option selected>Seléctioner un pays</option>
                                                <?php
                                                foreach ($list_pays as $pays) {
                                                    echo "<option value='" . $pays . "'>" . $pays . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class='col-4'>
                                            <label for='date_debut'>Date de début</label> 
                                            <input type="date" class="form-control form-control-user" name="date_debut" id="date_debut">
                                        </div>

                                        <div class="col-4">
                                            <label for='status_affaire'>Status</label>
                                            <select name="status_affaire" class="form-control">
                                                <option disabled selected>Seléctioner un status de ce numéro d'affaire</option>
                                                <?php
                                                foreach ($list_status as $status) {
                                                    echo "<option value='" . $status . "'>" . $status . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class='col-4'>
                                            <label for='date_fin'>Date de la fin</label> 
                                            <input type="date" class="form-control form-control-user" name="date_fin" id="date_debut">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="commentaire">Commentaires</label>
                                        <input type="text" class="form-control" name="commentaire" id="comment" placeholder="Ajouter des commentaires">
                                    </div>
                                    <hr>
                                    <input type="submit" value="Enrégistrer" class="btn btn-primary btn-user btn-block font-weight-bold">
                                </form>
                                <br>
                                <a class="small btn btn-warning btn-user btn-block text-dark" href="index.php">Retourner sur la liste des numéros d'affaire. <b>Ce numéro d'affaire ne sera pas enrégistré</b></a>
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
        include("../../inc/bottom.inc");
        ?>
    </body>
</html>
