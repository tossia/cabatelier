<?php
include("../../../inc/config.inc");

if (!is_logged()) {
    header("location:index.php");
    die();
}
include("../../inc/tableaux/liste_deroulante.inc");
$titlePage = "Ajouter un article";
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
                                <div class="text-center">

                                </div>
                                <!-- Formulaire -->
                                <form method="post" action="firstReg.php" class="user" name='form' onsubmit="new_article();return false">
                                    <h4 class="text-gray-900 text-center pb-3"><?php echo $titlePage; ?></h4>
                                    <div class="form-group d-flex d-block align-content-around d-inline-block">
                                        <label for='num_affaire' class='px-3'>Numéro d'affaire</label>
                                        <select name="num_affaire" class="form-control col-4">
                                            <option value=''>Seléctionez le numero d'affaire</option>
                                            <?php
                                            foreach ($list_affaire as $num_affaire) {
                                                echo "<option value='" . $num_affaire . "'>" . $num_affaire . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-4">
                                            <label for='reference'>Reference</label>
                                            <input type="text" required class="form-control form-control-user" name="reference" id="reference" value='' placeholder="Reference SPIE">                                            
                                        </div>
                                        <div class="col-8">
                                            <label for='designation'>Designation</label>
                                            <input type="text" required class="form-control form-control-user" name="designation" id="designation" value='' placeholder="Designation">                                            
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class='col-6'>
                                            <label for='fabricant'>Fabricant</label>
                                            <select name="fabricant" class="form-control">
                                                <option value=''>Seléctionez le fabricant</option>
                                                <?php
                                                foreach ($list_fabr as $fabricant) {
                                                    echo "<option value='" . $fabricant . "'>" . $fabricant . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for='num_serie'>Numéro de série</label>
                                            <input type="text" class="form-control form-control-user" name="num_serie" id="num_serie" onclick="numSerie()" value='' placeholder="Numéro de série">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class='col-4'>
                                            <label for='localisation'>Localisation</label> 
                                            <input type="text" required class="form-control form-control-user" name="localisation" id="localisation" value='' placeholder="Localisation">
                                        </div>
                                        <div class="col-4">
                                            <label for='repere'>Répére schéma</label>
                                            <input type="text" class="form-control form-control-user" name="repere" id="repere" value='' placeholder="Répére schéma">
                                        </div>
                                        <div class="col-4">
                                            <label for='folio'>Folio</label>
                                            <input type="folio" class="form-control form-control-user" name="folio" id="num_serie" value='' placeholder="Folio">
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
        <script>

        </script>
    </body>
</html>
