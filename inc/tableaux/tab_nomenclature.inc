<?php
$num_affaire = $_GET['num_affaire'];

$sql_affaire = "SELECT * FROM affaire WHERE num_affaire='".$num_affaire."'";
$stmt_affaire = $bdd->prepare($sql_affaire);
$stmt_affaire->execute();
$id_affaire = $stmt_affaire->fetch(PDO::FETCH_ASSOC)['id'];


$stock = 'SELECT stock.reference, stock.designation, fabricant.nom as fabricant, '
    . 'stock.num_serie, affaire.num_affaire, localisation.nom as loco, '
    . 'repere.nom as repere, num_folio.numero as folio, users.nom as user, stock.date_saisi '
    . 'FROM ((((((stock '
    . 'INNER JOIN fabricant ON stock.id_fabricant=fabricant.id) '
    . 'INNER JOIN affaire ON stock.id_affaire=affaire.id) '
    . 'INNER JOIN localisation ON stock.id_localisation=localisation.id) '
    . 'INNER JOIN repere ON stock.id_repere=repere.id) '
    . 'INNER JOIN num_folio ON stock.id_folio=num_folio.id) '
    . 'INNER JOIN users ON stock.saisi_par=users.id_user)'
    . 'WHERE id_affaire='.$id_affaire;

$stmt = $bdd->prepare($stock);
$stmt->execute();
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);


if (isset($_SESSION["message"])) {
    ?>
    <div class="text-danger font-weight-bold">
        <?php echo $_SESSION["message"]; ?>
        <a class="text-danger font-weight-bold" href="delete.php?id=<?php echo $_SESSION["item"]; ?>">Cliquez ici pour confirmer</a>
        <span class="text-dark"><b>OU</b></span>
        <a class="text-success font-weight-bold" href="index.php">Cliquez ici pour annuler</a>
    </div>
    <hr>
    <?php
    unset($_SESSION["message"]);
}
?>

<table id="table_id" class="display hover compact order-column stripe col" style="width:100%">
    <thead>
        <tr class="text-center">
            <th>Reference</th>
            <th>Designation</th>
            <th>Fabricant</th>
            <th>Numero série</th>
            <th>Numero d'affaire</th>
            <th>Localisation</th>
            <th>Répére schéma</th>
            <th>Folio</th>
            <th>Saisi par</th>
            <th>Date de saisi</th>
            <th></th>
            <th></th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($result as $scan) { ?>
            <tr>
                <td><?php echo $scan['reference']; ?></td>
                <td><?php echo $scan['designation']; ?></td>
                <td><?php echo $scan['fabricant']; ?></td>
                <td><?php echo $scan['num_serie']; ?></td>
                <td><?php echo $scan['num_affaire']; ?></td>
                <td><?php echo $scan['loco']; ?></td>
                <td><?php echo $scan['repere']; ?></td>
                <td><?php echo $scan['folio']; ?></td>
                <td><?php echo $scan['user']; ?></td>
                <td><?php echo $scan['date_saisi']; ?></td>
                <td class="text-center bg-danger"><a href = "confirmDel.php?item=<?php echo $scan['reference'] ?: ''; ?>">Supprimer</a></td>
                <td class="text-center bg-warning"><a href = "formUpdate.php?item=<?php echo $scan['reference'] ?: ''; ?>">Modifier</a></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr class="text-center">
            <th>Reference</th>
            <th>Designation</th>
            <th>Fabricant</th>
            <th>Numero série</th>
            <th>Numero d'affaire</th>
            <th>Localisation</th>
            <th>Répére schéma</th>
            <th>Folio</th>
            <th>Saisi par</th>
            <th>Date de saisi</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>

