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
$titlePage = "Page blanche";
?>
<!DOCTYPE html>
<html lang="fr">

    <head>

        <?php
        include "../inc/head.inc";
        ?>
        <title>Page blanche</title>
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

                    <div class="container-fluid">

                        <!-- Text -->
                        <div class="text-center mt-5">
                            <p class="lead text-gray-800 pt-5">Page blanche</p>
                        </div>
                        <!-- Bootstrap core JavaScript; Core plugin JavaScript; Custom scripts for all pages-->
                        <?php
                        include "../inc/bottom.inc";
                        ?>
                    </div>
                </div>
            </div>
    </body>

</html>