<?php
// Take all actions
$sql = "SELECT user_actions.id, user_actions.date, type_action.libelle AS "
        . "type_action, (SELECT users.nom FROM users WHERE users.id = user_actions.id_user_act) "
        . "AS user_act, (SELECT users.nom FROM users WHERE users.id_user = user_actions.id_user) "
        . "AS user_change, affaire.num_affaire AS num_affaire, stock.reference as materiel, "
        . "client.client, fabricant.nom as fabricant "
        . "FROM (((((user_actions "
        . "INNER JOIN type_action ON user_actions.id_action = type_action.id) "
        . "LEFT JOIN affaire ON user_actions.id_affaire = affaire.id) "
        . "LEFT JOIN stock ON user_actions.id_scan = stock.id) "
        . "LEFT JOIN client ON user_actions.id_client = client.id) "
        . "LEFT JOIN fabricant ON user_actions.id_fabricant = fabricant.id)"
        . "ORDER BY id";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);


?>


<table id="table_id" class="display table table-hover table-bordered col" style="width:100%">
    <thead>
        <tr class="text-center">
            <th>id</th>
            <th>Date</th>
            <th>Action</th>
            <th>Act par qui</th>
            <th>Act sur qui</th>
            <th>Numéro d'affaire</th>
            <th>Matériel scanné</th>
            <th>Cliént</th>
            <th>Fabricant</th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($result as $act) { ?>
            <tr>
                <td><?php echo $act['id']; ?></td>
                <td><?php echo $act['date']; ?></td>
                <td><?php echo $act['type_action']; ?></td>
                <td><?php echo $act['user_act']; ?></td>
                <td><?php echo $act['user_change']; ?></td>
                <td><?php echo $act['num_affaire']; ?></td>
                <td><?php echo $act['materiel']; ?></td>
                <td><?php echo $act['client']; ?></td>
                <td><?php echo $act['fabricant']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr class="text-center">
            <th>id</th>
            <th>Date</th>
            <th>Action</th>
            <th>Act par qui</th>
            <th>Act sur qui</th>
            <th>Numéro d'affaire</th>
            <th>Matériel scanné</th>
            <td>Cliént</td>
            <td>Fabricant</td>
        </tr>
    </tfoot>
</table>
