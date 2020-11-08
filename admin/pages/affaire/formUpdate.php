<?php
include("../../../inc/config.inc");

if (!is_logged()) {
    header("location:../../index.php");
    die();
}
if (!is_admin()) {
    header("location:../../../index.php");
    die();
}
include("../../inc/select_for_num_affaire.inc");

$titlePage = "Modifier un numéro d'affaire";

$id = $_GET["id"];

$all_num_aff = "SELECT affaire.id, affaire.num_affaire, client.client, pays.nom_fr_fr as pays, "
        . "affaire.date_debut, status_affaire.status, affaire.date_fin, affaire.commentaire "
        . "FROM (((affaire INNER JOIN client ON affaire.id_client=client.id) "
        . "LEFT JOIN status_affaire ON affaire.id_status=status_affaire.id) "
        . "LEFT JOIN pays on client.pays=pays.id) WHERE affaire.id=" . $id;
$stmt_num_aff = $bdd->prepare($all_num_aff);
$stmt_num_aff->execute();
$one_num_aff = $stmt_num_aff->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <?php
        include("../../inc/head.inc");
        ?>
        <title><?php $titlePage; ?></title>
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
                                    <h4 class="text-gray-900 mb-4"><?php echo $titlePage; ?> : <?php echo $one_num_aff['num_affaire']; ?> (ID = <?php echo $one_num_aff['id']; ?>)</h4>
                                </div>
                                <!-- Formulaire -->
                                <form method="post" action="update.php" class="user" name='form'>
                                    <input type="hidden" name="id" value='<?php echo $one_num_aff["id"]; ?>'>
                                    <div class="form-group d-flex">
                                        <div class="col-4">
                                            <label for='num_affaire'>Numéro d'affaire</label>
                                            <input type="text" class="form-control form-control-user" name="num_affaire" id="titre" value="<?php echo $one_num_aff["num_affaire"]; ?>">                                            
                                        </div>
                                        <div class='col-4'>
                                            <label for="client">Client</label>
                                            <select name="client" class="form-control">
                                                <?php
                                                foreach ($list_client as $client) {
                                                    if ($client == $one_num_aff['client']):
                                                        echo "<option selected value='" . $client . "'>" . $client . "</option>";
                                                    else:
                                                        echo "<option value='" . $client . "'>" . $client . "</option>";
                                                    endif;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class='col-4'>
                                            <label for="pays">Pays de livraison</label>
                                            <select name="pays" class="form-control">
                                                <option selected>Seléctioner un pays</option>
                                                <?php
                                                foreach ($list_pays as $pays) {
                                                    if ($pays == $one_num_aff['pays']):
                                                        echo "<option selected value='" . $pays . "'>" . $pays . "</option>";
                                                    else:
                                                        echo "<option value='" . $pays . "'>" . $pays . "</option>";
                                                    endif;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class='col-4'>
                                            <label for='date_debut'>Date de début</label> 
                                            <input type="date" class="form-control form-control-user" name="date_debut" id="date_debut" value="<?php echo $one_num_aff['date_debut']; ?>">
                                        </div>

                                        <div class="col-4">
                                            <label for='status_affaire'>Status</label>
                                            <select name="status_affaire" class="form-control">
                                                <?php
                                                foreach ($list_status as $status) {
                                                    if ($status == $one_num_aff['status']):
                                                        echo "<option selected value='" . $status . "'>" . $status . "</option>";
                                                    else :
                                                        echo "<option value='" . $status . "'>" . $status . "</option>";
                                                    endif;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class='col-4'>
                                            <label for='date_fin'>Date de la fin</label> 
                                            <input type="date" class="form-control form-control-user" name="date_fin" id="date_debut" value="<?php echo $one_num_aff['date_fin']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="commentaire">Commentaires</label>
                                        <input type="text" class="form-control" name="commentaire" id="comment" value="<?php echo $one_num_aff['commentaire']; ?>">
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
