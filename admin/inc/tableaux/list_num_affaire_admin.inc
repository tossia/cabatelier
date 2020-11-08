<?php
$affaires = "SELECT affaire.id, affaire.num_affaire, client.client, pays.nom_fr_fr as pays, "
        . "affaire.date_debut, status_affaire.status, affaire.date_fin, affaire.commentaire "
        . "FROM (((affaire INNER JOIN client ON affaire.id_client=client.id) "
        . "LEFT JOIN status_affaire ON affaire.id_status=status_affaire.id) "
        . "LEFT JOIN pays on client.pays=pays.id)";
$stmt = $bdd->prepare($affaires);
$stmt->execute();
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);

if (isset($_SESSION["message"])) {
    ?>
    <div class="text-danger font-weight-bold">
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
            <th>ID</th>
            <th>Numéro d'affaire</th>
            <th>Client</th>
            <th>Pays</th>
            <th>Date de début</th>
            <th>Status</th>
            <th>Date de fin</th>
            <th>Commentaires</th>
            <th></th>
            <th></th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($result as $affaire) { ?>
            <tr>
                <td><?php echo $affaire['id']; ?></td>
                <td><?php echo $affaire['num_affaire']; ?></td>
                <td><?php echo $affaire['client']; ?></td>
                <td><?php echo $affaire['pays']; ?></td>
                <td><?php echo $affaire['date_debut']; ?></td>
                <td><?php echo $affaire['status']; ?></td>
                <td><?php echo $affaire['date_fin']; ?></td>
                <td><?php echo $affaire['commentaire']; ?></td>
                <td class="text-center bg-danger"><a href = "confirmDel.php?id=<?php echo $affaire['id'] ?: ''; ?>">Supprimer</a></td>
                <td class="text-center bg-warning"><a href = "formUpdate.php?id=<?php echo $affaire['id'] ?: ''; ?>">Modifier</a></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr class="text-center">
            <th>ID</th>
            <th>Numéro d'affaire</th>
            <th>Client</th>
            <th>Pays</th>
            <th>Date de début</th>
            <th>Status</th>
            <th>Date de fin</th>
            <th>Commentaire</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>
