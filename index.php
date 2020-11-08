<?php
include("inc/config.inc");

if (!is_logged()) {
    header("location:admin/login.php");
    die();
}

include 'inc/tableaux/select_tableau_borde.inc';
$titlePage = "Bienvenue";
?>

<!doctype html>
<html lang="fr">
    <head>
        <?php
        include("inc/head.inc");
        ?>
    </head>
    <body>
<div class='wrapper'>
	<div class ='contente'>
        <?php
        include("inc/header.inc");
        ?>
        <h1 class="text-center"><?php echo $titlePage; ?></h1>
        <p class="text-center" id="doc_time"></p>
        <!-- Import a Nomenclature into database -->
        <form class="form-horizontal" action="import_bdd.php" method="post" enctype="multipart/form-data">
            <div class="input-row text-center mb-4">
                <label class="col-md-2 control-label">Importe une nomenclature</label> 
                <input type="file" name="import_file" accept=".xlsx">
                <button type="submit" id="submit" name="import" class="btn-submit btn-success">Import</button>
                <br />
            </div>
            <div id="labelError">

	</div>
        </form>

        <!-- End import block -->
        <div class='container mt-5'>
            <div class='row'>
                <div class='col-md'>
                    <dl>
                        <dt>Numéros d'affaires</dt>
                        <dd class="pt-2"><u>TOTAL</u> : <b><?php echo $somme_affaire; ?></b> ;</dd>
                        <dd>Créés mais pas commencé : <b><?php echo $aff_new; ?></b></dd>
                        <dd>En cours : <b><?php echo $en_cours; ?></b> ;</dd>
                        <dd>Clôturé : <b><?php echo $aff_fini; ?></b> ;</dd>
                        <dd>Dernière Numéro d'affaire : <b><?php echo $last_num; ?></b></dd>

                        <dt class="pt-3">Clients</dt>
                        <dd>Nombre des clients : <b><?php echo $total_clients; ?></b></dd>
                        <dd>Clients per pays</dd>
                    </dl>
                </div>
                <div class='col-md'>
                    <dl>
                        <dt>Matériel</dt>
                        <dd>Total scanné : <?php echo $somme_scan; ?> ;</dd>
                        <dd>Scanné aujourd'hui : <?php echo $today_scan; ?> ;</dd>

                    </dl>
                </div>
            </div>
        </div>
	</div>
        <div class="footer">
            <?php
            include "inc/footer.inc";
            ?>
        </div>
</div>
        <!-- Bootstrap core JavaScript; Core plugin JavaScript; Custom scripts for all pages-->
        <?php
        include "inc/bottom.inc";
        ?>
     </body>
</html>
