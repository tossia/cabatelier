<?php
include("../../inc/config.inc");

if (!is_logged()) {
    header("location:../../admin/login.php");
    die();
}
/*
if (is_user()) {
    header("location:../../index.php");
    die();
}
*/

$titlePage = "Liste des matériels";
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <?php
        include "../../inc/head.inc";
        ?>
    </head>

    <body>
        <!-- Page Wrapper -->
        <div class="wrapper">
            <div class="contente">
                <!-- Topbar -->
                <?php
                include '../../inc/header.inc';
                ?>
                <!-- End of Topbar -->
                <div class="text-center">
                    <h1 class="d-inline-block"><?php echo $titlePage; ?></h1>
                    <a href='registrer.php' class="btn btn-success ml-3 mb-3">Ajouter</a>
                </div> 
                <!-- Tableau des matériels -->
                <?php
                include '../../inc/tableaux/list_materiels.inc';
                ?>
                <!-- End tableau des matériels -->
            </div>
            <?php
            include "../../inc/footer.inc";
            ?>
            <!-- Bootstrap core JavaScript; Core plugin JavaScript; Custom scripts for all pages-->
            <?php
            include "../../inc/bottom.inc";
            include '../../inc/tableScript.inc';
            ?>
    </body>
</html>