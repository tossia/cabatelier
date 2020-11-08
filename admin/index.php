<?php
include("../inc/config.inc");

if (!$_SESSION["connection"]) {
    header("location:login.php");
    die();
}
/*
if (!is_admin()) {
    header("location:../index.php");
    die();
}

 */
$titlePage = "Tableau de bord";

include 'inc/tableaux/select_tableau_borde_admin.inc';
?>
<!DOCTYPE html>
<html lang="fr">

    <head>

        <?php
        include "inc/head.inc";
        ?>
        <title><?php echo '$titlePage'; ?></title>
    </head>

    <body id = "page-top">

        <!--Page Wrapper-->
        <div id = "wrapper">

            <!--Sidebar-->
            <?php
            include "inc/sidebar.inc";
            ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->

                <div id="content">

                    <!-- Topbar -->
                    <?php
                    include 'inc/header.inc';
                    ?>
                    <main>
                        <div class='text-center mb-5'>
                            <h1><?php echo $titlePage; ?></h1>
                            <span id="doc_time"></span>
                        </div>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-md'>
                                    <dl>
                                        <dt>Numéros d'affaires</dt>
                                        <dd class="pt-2">Nombre total : <b><?php echo $somme_affaire; ?></b> ;</dd>
                                        <dd>Dernière Numéro d'affaire : <b><?php echo $last_num; ?></b></dd>
                                        
                                        <dt class="pt-3">Clients</dt>
                                        <dd>Nombre des clients : <b><?php echo $total_clients; ?></b></dd>
                                        
                                        <dt class="pt-3">Fabricants</dt>
                                        <dd>Nombre des fabricants : <b><?php echo $total_fabricant; ?></b></dd>
                                        
                                        <dt class="pt-3">Items dans le stock</dt>
                                        <dd>Total : <b><?php echo $somme_scan; ?></b></dd>
                                        <dd>Total avec Num de Série : <?php echo $nomber_serie; ?></dd>
                                    </dl>
                                </div>
                                <div class='col-md'>
                                    <dl>
                                        <dt>Utilisateurs</dt>
                                        <dd><u>Nombre total : <?php echo $total_users; ?> </u>;</dd>
                                        <dd>Simple Utilisatuers : <?php echo $total_utilisateurs; ?> ;</dd>
                                        <dd>Supervisors : <?php echo $total_supervis; ?> ;</dd>
                                        <dd>Administrators : <?php echo $total_admin; ?> ;</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- END Content -->
                </div>
                <!--END Content Wrapper -->
            </div>
            <!--END Page Wrapper-->
        </div>

        <!-- Bootstrap core JavaScript; Core plugin JavaScript; Custom scripts for all pages-->
        <?php

        include "inc/bottom.inc";
        ?>
    </body>
</html>
