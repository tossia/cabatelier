<?php

/*Liste deroulante des fabricants */
$all_fabricant = "SELECT nom FROM fabricant";
$stmt_fabr = $bdd->prepare($all_fabricant);
$stmt_fabr->execute();
$list_fabr = array_column($stmt_fabr->fetchAll(PDO::FETCH_ASSOC), 'nom');

/*Liste deroulante des affaires */
$all_affaire = "SELECT num_affaire FROM affaire";
$stmt_affaire = $bdd->prepare($all_affaire);
$stmt_affaire->execute();
$list_affaire = array_column($stmt_affaire->fetchAll(PDO::FETCH_ASSOC), 'num_affaire');

/*Liste deroulante des emplacements */
$all_places = "SELECT titre_emplacement FROM emplacement";
$stmt_place = $bdd->prepare($all_places);
$stmt_place->execute();
$list_place = array_column($stmt_place->fetchAll(PDO::FETCH_ASSOC), 'titre_emplacement');


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