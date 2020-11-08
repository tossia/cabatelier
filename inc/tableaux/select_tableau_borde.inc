<?php
// The last affaire's number
$sql_num = "SELECT * FROM affaire WHERE id= (SELECT MAX(id) FROM affaire)";
$stmt_num = $bdd->prepare($sql_num);
$stmt_num->execute();
$last_num = $stmt_num->fetch(PDO::FETCH_ASSOC)['num_affaire'];

//Total affaire's numbers
$sql_total_aff = "SELECT COUNT(id) FROM affaire";
$stmt_total_aff = $bdd->prepare($sql_total_aff);
$stmt_total_aff->execute();
$somme_affaire = $stmt_total_aff->fetch(PDO::FETCH_ASSOC)['COUNT(id)'];

//Total new affaire's numbers nit started
$sql_new_aff = "SELECT COUNT(id) FROM affaire WHERE id_status='1'";
$stmt_new_aff = $bdd->prepare($sql_new_aff);
$stmt_new_aff->execute();
$aff_new = $stmt_new_aff->fetch(PDO::FETCH_ASSOC)['COUNT(id)'];

//Total affaire's numbers in process
$sql_aff_en_cours = "SELECT COUNT(id) FROM affaire WHERE id_status='2'";
$stmt_aff_en_cours = $bdd->prepare($sql_aff_en_cours);
$stmt_aff_en_cours->execute();
$en_cours = $stmt_aff_en_cours->fetch(PDO::FETCH_ASSOC)['COUNT(id)'];

//Total closed affaire's numbers
$sql_aff_fini = "SELECT COUNT(id) FROM affaire WHERE id_status='3'";
$stmt_aff_fini = $bdd->prepare($sql_aff_fini);
$stmt_aff_fini->execute();
$aff_fini = $stmt_aff_fini->fetch(PDO::FETCH_ASSOC)['COUNT(id)'];

//Total scanned items
$sql_stock = "SELECT COUNT(id) FROM stock";
$stmt_stock = $bdd->prepare($sql_stock);
$stmt_stock->execute();
$somme_scan = $stmt_stock->fetch(PDO::FETCH_ASSOC)['COUNT(id)'];

// Items with serie number
$sql_serie = "SELECT COUNT(num_serie) FROM stock";
$stmt_serie = $bdd->prepare($sql_serie);
$stmt_serie->execute();
$nomber_serie = $stmt_serie->fetch(PDO::FETCH_ASSOC)['COUNT(num_serie)'];

//Total TODAY scanned items
$sql_scan_today = "SELECT COUNT(id) FROM stock WHERE CAST(date_saisi AS DATE) = CAST(NOW() AS DATE)";
$stmt_scan_today = $bdd->prepare($sql_scan_today);
$stmt_scan_today->execute();
$today_scan = $stmt_scan_today->fetch(PDO::FETCH_ASSOC)['COUNT(id)'];

//Total number of clients
$sql_client = "SELECT COUNT(id) FROM client";
$stmt_client = $bdd->prepare($sql_client);
$stmt_client->execute();
$total_clients = $stmt_client->fetch(PDO::FETCH_ASSOC)['COUNT(id)'];

//Total number of fabricants
$sql_fabricant = "SELECT COUNT(id) FROM fabricant";
$stmt_fabricant = $bdd->prepare($sql_fabricant);
$stmt_fabricant->execute();
$total_fabricant = $stmt_fabricant->fetch(PDO::FETCH_ASSOC)['COUNT(id)'];



?>