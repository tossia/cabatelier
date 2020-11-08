<?php
// Take all users
$all_users = "SELECT users.id, id_user, nom, login, droit.droit as droit, commentaire  "
        . "FROM (users "
        . "LEFT JOIN droit on users.droit=droit.id)";
$stmt_users = $bdd->prepare($all_users);
$stmt_users->execute();
$users = $stmt_users->fetchALL(PDO::FETCH_ASSOC);


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

<table id="table_id" class="display table table-hover table-bordered col" style="width:100%">

    <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>id User</th>
            <th>Nom</th>
            <th>Login</th>
            <th>Droits</th>
            <th>Commentaires</th>
            <th></th>
            <th></th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['id_user']; ?></td>
                <td><?php echo $user['nom']; ?></td>
                <td><?php echo $user['login']; ?></td>
                <td><?php echo $user['droit']; ?></td>
                <td><?php echo $user['commentaire']; ?></td>
                <td class="text-center bg-danger"><a href = "confirmDel.php?id_user=<?php echo $user['id_user'] ?: ''; ?>">Supprimer</a></td>
                <td class="text-center bg-warning"><a href = "formUpdate.php?id_user=<?php echo $user['id_user'] ?: ''; ?>">Modifier</a></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr class="text-center">
            <th>ID</th>
            <th>id User</th>
            <th>Nom</th>
            <th>Login</th>
            <th>Droits</th>
            <th>Commentaires</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>
