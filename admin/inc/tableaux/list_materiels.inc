<?php
$stock = 'SELECT stock.id, affaire.num_affaire, emplacement.titre_emplacement as emplacement,'
        . 'repere, folio, reference, fabricant.nom as fabricant, designation, num_serie, '
        . 'users.nom as user, stock.date_saisi '
        . 'FROM ((((stock '
        . 'LEFT JOIN affaire ON stock.id_affaire=affaire.id) '
        . 'LEFT JOIN emplacement ON stock.id_emplacement=emplacement.id) '
        . 'LEFT JOIN fabricant ON stock.id_fabricant=fabricant.id) '
        . 'LEFT JOIN users ON stock.saisi_par=users.id_user)';
$stmt = $bdd->prepare($stock);
$stmt->execute();
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<?php if (isset($_SESSION["message"])) {
    ?>
    <div>
        <?php echo $_SESSION["message"]; ?>
        <a class="text-danger font-weight-bold" href="delete.php?id=<?php echo $_SESSION["id"]; ?>">Cliquez ici pour confirmer</a>
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
            <th>Numero d'affaire</th>
            <th>Emplacement</th>
            <th>Repère</th>
            <th>Folio</th>
            <th>Reference</th>
            <th>Fabricant</th>
            <th>Designation</th>
            <th>Numero série</th>
            <th>Saisi par</th>
            <th>Date de saisi</th>
            <th></th>
            <th></th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($result as $scan) { ?>
            <tr>
                <td><?php echo $scan['num_affaire']; ?></td>
                <td><?php echo $scan['emplacement']; ?></td>
                <td><?php echo $scan['repere']; ?></td>
                <td><?php echo $scan['folio']; ?></td>
                <td><?php echo $scan['reference']; ?></td>
                <td><?php echo $scan['fabricant']; ?></td>
                <td><?php echo $scan['designation']; ?></td>
                <td><?php echo $scan['num_serie']; ?></td>
                <td><?php echo $scan['user']; ?></td>
                <td><?php echo $scan['date_saisi']; ?></td>
                <td class="text-center bg-danger"><a href = "confirmDel.php?id=<?php echo $scan['id'] ?: ''; ?>">Supprimer</a></td>
                <td class="text-center bg-warning"><a href = "formUpdate.php?id=<?php echo $scan['id'] ?: ''; ?>">Modifier</a></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr class="text-center">
            <th>Numero d'affaire</th>
            <th>Emplacement</th>
            <th>Repère</th>
            <th>Folio</th>
            <th>Reference</th>
            <th>Fabricant</th>
            <th>Designation</th>
            <th>Numero série</th>
            <th>Saisi par</th>
            <th>Date de saisi</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>

