<?php
include('../inc/config.inc');

if (!is_logged()) {
    header("location:../admin/login.php");
    die();
}

$titlePage = "Liste des fabricants";
?>
<!doctype html>
<html lang="fr">
    <head>
        <?php
        include("../inc/head.inc");
        ?>
    </head>
    <body>
        <?php
        include("../inc/header.inc");
        ?>
        <h1 class="text-center"><?php echo $titlePage; ?></h1>

        <br>
        <!-- Start tableau -->
        <?php
        include '../inc/tableaux/list_fabricants.inc'
        ?>
        <!-- End tableau -->

        <?php
        include "../inc/footer.inc";
        ?>
        <!-- Bootstrap core JavaScript; Core plugin JavaScript; Custom scripts for all pages-->
        <?php
        include "../inc/bottom.inc";
        include '../inc/tableScript.inc';
        ?>

</body>
</html>
