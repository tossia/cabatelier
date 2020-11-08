<?php
/* Liste deroulante des pays à choisir*/
$pays = "SELECT nom_fr_fr FROM pays";
$stmt = $bdd->prepare($pays);
$stmt->execute();
$list_pays = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'nom_fr_fr');

/*Liste deroulante des clients à choisir */
$all_clients = "SELECT client FROM client";
$stmt = $bdd->prepare($all_clients);
$stmt->execute();
$list_client = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'client');

/*Liste deroulante des status des numéros d'affaire */
$all_status = "SELECT status FROM status_affaire";
$stmt = $bdd->prepare($all_status);
$stmt->execute();
$list_status = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'status');
