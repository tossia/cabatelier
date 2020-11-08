<?php
include("../../../inc/config.inc");

if (!is_logged()) {
    header("location:../../login.php");
    die();
}
if (is_user()) {
    header("location:../../index.php");
    die();
}

$titlePage = "Liste des clients";
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <?php
        include "../../inc/head.inc";
        ?>
    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <?php
            include "../../inc/sidebar.inc";
            ?>
            <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <?php
                    include '../../inc/header.inc';
                    ?>
                    <!-- End of Topbar -->
                    <div class="text-center">
                        <h1 class="d-inline-block"><?php echo $titlePage; ?></h1>
                        <a href='registrer.php' class="btn btn-success ml-3 mb-3">Ajouter</a>
                    </div> 
                    <!-- Tableau des clients -->
                    <?php
                    include '../../../inc/tableaux/list_clients.inc';
                    ?>
                    <!-- End tableau des clients -->
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript; Core plugin JavaScript; Custom scripts for all pages-->
        <?php
        include "../../inc/bottom.inc";
        include "../../inc/tableScript.inc";
        ?>
    </body>
</html>


