<?php
include("../../inc/config.inc");

if (!is_logged()) {
    header("location:../../index.php");
    die();
}
$titlePage = "Ajouter le numéro de série";

$id = $_GET["id"];

$sql_stock = "SELECT stock.id, emplacement.titre_emplacement as emplacement, reference, fabricant.nom as fabricant, num_serie, "
        . "equipe.titre_equipe, repere, users.nom as user, date_saisi "
        . "FROM ((((stock "
        . "LEFT JOIN emplacement on stock.id_emplacement=emplacement.id) "
        . "LEFT JOIN fabricant on stock.id_fabricant=fabricant.id) "
        . "LEFT JOIN equipe on stock.id_equipe=equipe.id) "
        . "LEFT JOIN users on stock.saisi_par=users.id_user) "
        . "WHERE stock.id=" . $id;

$stmt_stock = $bdd->prepare($sql_stock);
$stmt_stock->execute();
$one_item = $stmt_stock->fetch(PDO::FETCH_ASSOC);
/*
echo '<pre>';
print_r($one_item);
echo '</pre>';
die();
*/
include("../../inc/stock_liste_deroulante.inc");
?>


<!DOCTYPE html>
<html lang="fr">

    <head>
        <title><?php echo '$titlePage'; ?></title>
        <?php
        include("../../inc/head.inc");
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
                                <!-- Formulaire -->
                                <form method="post" action="update.php" class="user" name='form' onsubmit="new_article()">
                                    <input type="hidden" name="id" value='<?php echo $one_item["id"]; ?>'>
                                    <h4 class="text-gray-900 text-center"><?php echo $titlePage; ?></h4>
                                    <div class="form-group d-flex">
                                        <div class="col-4 col-sm-6">
                                            <label for='titre_equipe'>Titre équipement</label>
                                            <input disabled type="text" class="form-control form-control-user" name="titre_equipe" id="titre_equipe" value='<?php echo $one_item['titre_equipe']; ?>'>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-4">
                                            <label for='repere'>Repére schema</label>
                                            <input disabled type="text" class="form-control form-control-user" name="repere" id="repere" value='<?php echo $one_item['repere']; ?>'>
                                        </div>
                                        <div class="col-4">
                                            <label for='emplacement'>Emplacement</label>
                                            <select name="emplacement" class="form-control">
                                                <option  id="emplacement" value='' required>Seléctionez un emplacement</option>
                                                <?php
                                                foreach ($list_place as $place) {
                                                    if ($place == $one_item['emplacement']):
                                                        echo "<option selected value='" . $place . "'>" . $place . "</option>";
                                                    else:
                                                        echo "<option value='" . $place . "'>" . $place . "</option>";
                                                    endif;
                                                }
                                                ?>
                                            </select>                                            
                                        </div>
                                        <div class="col-4">
                                            <label for='reference'>Reference</label>
                                            <input disabled type="text" class="form-control form-control-user" name="reference" id="reference" value='<?php echo $one_item['reference']; ?>'>                                            
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class='col-6'>
                                            <label for='fabricant'>Fabricant</label>
                                            <input disabled type="text" class="form-control form-control-user" name="fabricant" id="fabricant" value='<?php echo $one_item['fabricant']; ?>'>
                                        </div>
                                        <div class="col-6">
                                            <label for='num_serie'>Numéro de série</label>
                                            <input required type="text" class="form-control form-control-user" name="num_serie" 
                                                   id="num_serie" value='<?php echo $one_item['num_serie']; ?>' onclick="numSerie()">
                                        </div>
                                    </div>
                                    <hr>
                                    <input type="submit" value="Enrégistrer" class="btn btn-primary btn-user btn-block font-weight-bold">
                                </form>
                                <br>
                                <a class="small btn btn-warning btn-user btn-block text-dark" href="index.php">Retourner sur la liste des matériels. <b>Cet article ne sera pas enrégistré</b></a>
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
