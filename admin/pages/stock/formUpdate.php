<?php
include("../../../inc/config.inc");

if (!is_logged()) {
    header("location:index.php");
    die();
}
$titlePage = "Modification de un article";

$id = $_GET["id"];

$sql_stock = "SELECT stock.id, reference, stock.designation, fabricant.nom as fabricant, num_serie, "
        . "affaire.num_affaire, repere, folio, users.nom as user, date_saisi "
        . "FROM stock "
        . "LEFT JOIN fabricant on stock.id_fabricant=fabricant.id "
        . "LEFT JOIN affaire on stock.id_affaire=affaire.id "
        . "LEFT JOIN users on stock.saisi_par=users.id_user "
        . "WHERE stock.id=" . $id;

$stmt_stock = $bdd->prepare($sql_stock);
$stmt_stock->execute();
$one_item = $stmt_stock->fetch(PDO::FETCH_ASSOC);

//Listes deroulantes
include("../../inc/tableaux/liste_deroulante.inc");

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
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-11 mx-auto">
                            <div class="p-5">
                                <div class="text-center">

                                </div>
                                <!-- Formulaire -->
                                <form method="post" action="update.php" class="user" name='form' onsubmit="return new_article()">
                                    <input type="hidden" name="id" value='<?php echo $one_item["id"]; ?>'>
                                    <div class="form-group d-flex d-block align-content-around">
                                        <h4 class="text-gray-900 pr-4"><?php echo $titlePage; ?> pour le référence : <?php echo $one_item["reference"]; ?></h4>
                                        <div class="col-3 d-inline">
                                            <label for='num_affaire' class='pr-2'>Numéro d'affaire</label>
                                            <select name="num_affaire" class="">
                                                <?php
                                                foreach ($list_affaire as $num_affaire) {
                                                    if ($num_affaire == $one_item['num_affaire']):
                                                        echo "<option selected value='" . $num_affaire . "'>" . $num_affaire . "</option>";
                                                    else:
                                                        echo "<option value='" . $num_affaire . "'>" . $num_affaire . "</option>";
                                                    endif;
                                                }
                                                ?>
                                            </select>                                         
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-4">
                                            <label for='reference'>Reference</label>
                                            <input type="text" class="form-control form-control-user" name="reference" id="reference" value='<?php echo $one_item["reference"]; ?>'>                                            
                                        </div>
                                        <div class="col-8">
                                            <label for='designation'>Designation</label>
                                            <input type="text" class="form-control form-control-user" name="designation" id="designation" value='<?php echo $one_item["designation"]; ?>'>                                            
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class='col-6'>
                                            <label for='fabricant'>Fabricant</label> 
                                            <select name="fabricant" class="form-control">
                                                <?php
                                                foreach ($list_fabr as $fabricant) {
                                                    if ($fabricant == $one_item['fabricant']):
                                                        echo "<option selected value='" . $fabricant . "'>" . $fabricant . "</option>";
                                                    else:
                                                        echo "<option value='" . $fabricant . "'>" . $fabricant . "</option>";
                                                    endif;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for='num_serie'>Numéro de série</label>
                                            <input type="text" class="form-control form-control-user" name="num_serie" id="num_serie" onclick="numSerie()" value='<?php echo $one_item["num_serie"]; ?>'>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-4">
                                            <label for='repere'>Répére schéma</label>
                                            <input type="text" class="form-control form-control-user" name="repere" id="repere" value='<?php echo $one_item["repere"]; ?>'>                       
                                        </div>
                                        <div class="col-4">
                                            <label for='folio'>Folio</label>
                                            <input type="text" class="form-control form-control-user" name="folio" id="folio" value='<?php echo $one_item["folio"]; ?>'>                       
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
