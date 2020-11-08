<?php
include('../inc/config.inc');

if (!is_logged()) {
    header("location:../admin/login.php");
    die();
}

$titlePage = "Clients";
?>
<!doctype html>
<html lang="fr">
    <head>
        <?php
        include("../inc/head.inc");
        ?>
    </head>
    <body>
    <div class="wrapper">
            <div class="contente">
        <?php
        include("../inc/header.inc");
        ?>
        <h1 class="text-center"><?php echo $titlePage; ?></h1>
        <!-- Start tableau -->
        <?php
        include '../inc/tableaux/list_clients.inc';
        ?>
        <!-- End tableau -->
        </div>
        <?php
        include "../inc/footer.inc";
        ?>
        <!-- Bootstrap core JavaScript; Core plugin JavaScript; Custom scripts for all pages-->
        <?php
        include "../inc/bottom.inc";
        include "../inc/tableScript.inc";
        ?>

</div>
</body>
</html>

