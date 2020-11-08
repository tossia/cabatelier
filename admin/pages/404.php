<?php
include("../../inc/config.inc");

if(!is_logged()) {
header("location:../index.php");
die();
}
if(!is_admin()) {
    header("location:../index.php");
}

$titlePage = "Page 404";
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        include("../inc/head.inc");
        ?>
        <title>Page 404</title>
    </head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php
            include("../inc/sidebar.inc");
            ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php
                    include('../inc/header.inc');
                    ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- 404 Error Text -->
                        <div class="text-center mt-5">
                            <div class="error mx-auto" data-text="404">404</div>
                            <p class="lead text-gray-800 mb-5">Page Not Found</p>

                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <?php
                include('../inc/footer.inc');
                ?>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->

        <?php
        include('../inc/logOutModule.php');
        ?>
        </div>

        <!--Bootstrap core JavaScript;
        Core plugin JavaScript;
        Custom scripts for all pages-->
        <?php
        include "../inc/bottom.inc";
        ?>

    </body>

</html>

