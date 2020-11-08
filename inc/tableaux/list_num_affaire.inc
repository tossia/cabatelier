<?php
$affaires = "SELECT equipe.id, affaire.num_affaire, affaire.titre_affaire, equipe.titre_equipe "
        . "as equipe, client.client, pays.nom_fr_fr as pays, affaire.date_debut, "
        . "status_affaire.status, affaire.date_fin, affaire.commentaire\n"
    . "FROM (((((stock\n"
    . "LEFT JOIN equipe ON stock.id_equipe=equipe.id)\n"
    . "LEFT JOIN affaire ON equipe.id_affaire=affaire.id)\n"
    . "LEFT JOIN client ON affaire.id_client=client.id)\n"
    . "LEFT JOIN status_affaire ON affaire.id_status=status_affaire.id)\n"
    . "LEFT JOIN pays on client.pays=pays.id)\n"
    . "GROUP BY equipe "
        . "ORDER BY num_affaire";


$stmt = $bdd->prepare($affaires);
$stmt->execute();
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>

<table id="table_id" class="display hover compact order-column stripe col" style="width:100%">
    <thead>
        <tr class="text-center">
            <th hidden>id</th>
            <th>Numéro d'affaire</th>
            <th>Equipement</th>
            <th>Titre affaire</th>
            <th>Client</th>
            <th>Pays</th>
            <th>Date de début</th>
            <th>Status</th>
            <th>Date de fin</th>
            <th>Commentaires</th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($result as $affaire) { ?>
            <tr>
                <td hidden><?php echo $affaire['id']; ?></td>
                <td><?php echo $affaire['num_affaire'];?></td>
                <td class="text-dark equipe"><a href="<?php echo SITE_URL; ?>/pages/nomenclarure/index.php?id_equipe=<?php echo $affaire['equipe'] ?: ''; ?>"><?php echo $affaire['equipe']; ?></a></td>
                <td><?php echo $affaire['titre_affaire']; ?></td>
                <td><?php echo $affaire['client']; ?></td>
                <td><?php echo $affaire['pays']; ?></td>
                <td><?php echo $affaire['date_debut']; ?></td>
                <td><?php echo $affaire['status']; ?></td>
                <td><?php echo $affaire['date_fin']; ?></td>
                <td><?php echo $affaire['commentaire']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr class="text-center">
            <th hidden>id</th>
            <th>Numéro d'affaire</th>
            <th>Equipement</th>
            <th>Titre affaire</th>
            <th>Client</th>
            <th>Pays</th>
            <th>Date de début</th>
            <th>Status</th>
            <th>Date de fin</th>
            <th>Commentaire</th>
        </tr>
    </tfoot>
</table>
