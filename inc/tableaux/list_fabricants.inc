<?php
$fabricant = 'SELECT fabricant.id, nom, pays.nom_fr_fr as pays, adresse, contact_person, email, phone, commentaire '
    . 'FROM (fabricant '
    . 'LEFT JOIN pays on fabricant.pays=pays.id)';

$stmt = $bdd->prepare($fabricant);
$stmt->execute();
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<?php if (isset($_SESSION["message"])) {
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

<br>
<table id="table_id" class="display hover compact order-column stripe col" style="width:100%">
    <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Nom</th>
            <th>Pays</th>
            <th>Adresse</th>
            <th>Person en contact</th>
            <th>E-mail</th>
            <th>Numéro de téléphone</th>
            <th>Commentaires</th>
            <th hidden></th>
            <th hidden></th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($result as $madeBy) { ?>
            <tr>
                <td><?php echo $madeBy['id']; ?></td>
                <td><?php echo $madeBy['nom']; ?></td>
                <td><?php echo $madeBy['pays']; ?></td>
                <td><?php echo $madeBy['adresse']; ?></td>
                <td><?php echo $madeBy['contact_person']; ?></td>
                <td><?php echo $madeBy['email']; ?></td>
                <td><?php echo $madeBy['phone']; ?></td>
                <td><?php echo $madeBy['commentaire']; ?></td>
                <td hidden class="text-center bg-danger"><a href = "confirmDel.php?id=<?php echo $madeBy['id'] ?: ''; ?>">Supprimer</a></td>
                <td hidden class="text-center bg-warning"><a href = "formUpdate.php?id=<?php echo $madeBy['id'] ?: ''; ?>">Modifier</a></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr class="text-center">
            <th>ID</th>
            <th>Nom</th>
            <th>Pays</th>
            <th>Adresse</th>
            <th>Person en contact</th>
            <th>E-mail</th>
            <th>Numéro de téléphone</th>
            <th>Commentaires</th>
            <th hidden></th>
            <th hidden></th>
        </tr>
    </tfoot>
</table>

