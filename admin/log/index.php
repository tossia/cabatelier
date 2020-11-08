<?php
include("../inc/config.inc");

if (!is_logged()) {
    header("location:../login.php");
    die();
}
//debug($_SESSION);

if (is_user()) {
    header("location:../index.php");
    die();
}

$titlePage = "Registre des actions";

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <?php
        include "../inc/head.inc";
        ?>
        <title><?php echo '$titlePage'; ?></title>
    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php
            include "../inc/sidebar.inc";
            ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php
                    include '../inc/header.inc';
                    ?>
                    <!-- End of Topbar -->
                    <h1 class="text-center"><?php echo $titlePage; ?></h1>
                    <br>

                    <?php
                    include '../inc/tableaux/list_actions.inc';
                    ?>
                </div>
            </div>
        </div>
         <!-- Bootstrap core JavaScript; Core plugin JavaScript; Custom scripts for all pages-->
        <?php
        include "../inc/bottom.inc";
        include '../../inc/tableScript.inc';
        ?>
    </body>
</html>

