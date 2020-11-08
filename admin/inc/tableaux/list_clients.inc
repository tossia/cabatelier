<?php
$clients = 'SELECT client.id, client.client, pays.nom_fr_fr as pays, client.adresse, client.contact_person, '
        .'client.email, client.phone, client.commentaire '
        .'FROM (client '
        . 'INNER JOIN pays on client.pays=pays.id)';
$stmt = $bdd->prepare($clients);
$stmt->execute();
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<?php if (isset($_SESSION["message"])) {
    ?>
    <div class="text-danger font-weight-bold">
        <?php echo $_SESSION["message"]; ?>
        <a class="text-danger font-weight-bold" href="delete.php?id=<?php echo $_SESSION["id"] ?>">Cliquez ici pour confirmer</a>
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
        <tr class='text-center'>
            <th>ID</th>
            <th>Client</th>
            <th>Pays</th>
            <th>Adresse</th>
            <th>Person de contact</th>
            <th>E-mail</th>
            <th>Téléphone</th>
            <th>Commentaire</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $client) { ?>
            <tr>
                <td><?php echo $client['id']; ?></td>              
                <td><?php echo $client['client']; ?></td>
                <td><?php echo $client['pays']; ?></td>
                <td><?php echo $client['adresse']; ?></td>
                <td><?php echo $client['contact_person']; ?></td>
                <td><?php echo $client['email']; ?></td>
                <td><?php echo $client['phone']; ?></td>
                <td><?php echo $client['commentaire']; ?></td>
                <td class="text-center bg-danger"><a href = "confirmDel.php?id=<?php echo $client['id']; ?>">Supprimer</a></td>
                <td class="text-center bg-warning"><a href = "formUPDATE.php?id=<?php echo $client['id']; ?>">Modifier</a></td>
            </tr>
            <?php } ?>
    </tbody>
    <tfoot>
        <tr class='text-center'>
            <th>ID</th>
            <th>Client</th>
            <th>Pays</th>
            <th>Adresse</th>
            <th>Person de contact</th>
            <th>E-mail</th>
            <th>Téléphone</th>
            <th>Commentaire</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>