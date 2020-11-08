<?php
include("../../inc/config.inc");

if (!is_logged()) {
    header("location:../admin/login.php");
    die();
}

if (isset($_GET['id_equipe'])):
    $id_equipe_initial = $_GET['id_equipe'];
    $_SESSION['equipe'] = $id_equipe_initial;
else:
    $id_equipe_initial = $_SESSION['equipe'];
endif;

$sql_equipe = "SELECT id FROM equipe WHERE titre_equipe='" . $_SESSION['equipe']."'";
$stmt_equipe = $bdd->prepare($sql_equipe);
$stmt_equipe->execute();
$id_equipe = $stmt_equipe->fetch(PDO::FETCH_ASSOC)['id'];

$stock = 'SELECT stock.id, affaire.num_affaire, stock.id_equipe, emplacement.titre_emplacement as emplacement, '
        . 'repere, folio, reference, fabricant.nom as fabricant, stock.designation, '
        . 'stock.num_serie, users.nom as user, stock.date_saisi '
        . 'FROM ((((stock , equipe '
        . 'LEFT JOIN affaire ON equipe.id_affaire=affaire.id) '
        . 'LEFT JOIN emplacement ON stock.id_emplacement=emplacement.id) '
        . 'LEFT JOIN fabricant ON stock.id_fabricant=fabricant.id) '
        . 'LEFT JOIN users ON stock.saisi_par=users.id_user) '
        . 'WHERE id_equipe=' . $id_equipe . ' GROUP BY stock.id';

$stmt = $bdd->prepare($stock);
$stmt->execute();
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);

$_SESSION['num_affaire'] = $result[0]['num_affaire'];
/*
echo '<pre>';
print($result[0]['num_affaire']);
print_r($result);

echo '</pre>';
*/


$titlePage = "Nomenclature";
?>

<html lang="fr">
    <head>
        <?php
        include("../../inc/head.inc");
        ?>
    </head>
    <body>
        <div class="wrapper">
            <div class="contente">
        <?php
        include("../../inc/header.inc");
        ?>
        <div class="text-center">
            <h1 class="d-inline-block"><?php echo $titlePage; ?> pour l'equipement : <?php echo $_SESSION['equipe']; ?> </h1>
            <h2 class="d-inline-block">(N. d'affaire <?php echo $_SESSION['num_affaire']; ?>)</h2>
            <a href='<?php echo SITE_URL; ?>/pdf_releve.php?num_affaire=<?php echo $_SESSION['equipe'] ?: ''; ?>' class="btn btn-primary ml-3 mb-3">Generer un Fiche de releve</a>
        </div>
        <!-- Start tableau -->
        <table id="table_id" class="display hover compact order-column stripe col" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th hidden>id</th>
                    <th>Repère schéma</th>
                    <th>Emplacement</th>
                    <th>Reference</th>
                    <th>Designation</th>
                    <th>Numero série</th>
                    <th>Fabricant</th>
                    <th hidden>Saisi par</th>
                    <th hidden>Date de saisi</th> 
                    <th></th>
                </tr> 
            </thead>
            <tbody>
                <?php foreach ($result as $scan) { ?>
                    <tr>
                        <td hidden><?php echo $scan['id']; ?></td>
                        <td><?php echo $scan['repere']; ?></td>
                        <td><?php echo $scan['emplacement']; ?></td>
                        <td><?php echo $scan['reference']; ?></td>
                        <td><?php echo $scan['designation']; ?></td>
                        <td><?php echo $scan['num_serie']; ?></td>
                        <td><?php echo $scan['fabricant']; ?></td>
                        <td hidden><?php echo $scan['user']; ?></td>
                        <td hidden><?php echo $scan['date_saisi']; ?></td> 
                        <td class="text-center bg-warning"><a href = "formUpdate.php?id=<?php echo $scan['id'] ?: ''; ?>">Modifier</a></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr class="text-center">
                    <th hidden>id</th>
                    <th>Repère schéma</th>
                    <th>Emplacement</th>
                    <th>Reference</th>
                    <th>Designation</th>
                    <th>Numero série</th>
                    <th>Fabricant</th>
                    <th hidden>Saisi par</th>
                    <th hidden>Date de saisi</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <!-- End tableau -->
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
