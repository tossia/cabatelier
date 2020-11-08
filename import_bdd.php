<?php

include("inc/config.inc");

if (!is_logged()) {
    header("location:login.php");
    die();
}

require_once "vendor/autoload.php";

require_once("vendor/SpreadsheetReader.php");
/* require_once("vendor/phpoffice/php-excel-reader/SpreadsheetReader_XLS.php");
require_once("vendor/phpoffice/php-excel-reader/SpreadsheetReader_XLSX.php");
require_once("vendor/phpoffice/php-excel-reader/SpreadsheetReader_CSV.php");
require_once("vendor/phpoffice/php-excel-reader/SpreadsheetReader_ODS.php");
*/

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


if (isset($_POST["import"])) {
//Check if the file has a right format, accept only XLSX format
    $allowedFileType = ["application/vnd.ms-excel", "text/xlsx", "application/octet-stream", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
    if (in_array($_FILES["import_file"]["type"], $allowedFileType)) {
//Downloading the file into unloads folder
        $targetPath = "upload/" . $_FILES["import_file"]["name"];
        move_uploaded_file($_FILES["import_file"]["tmp_name"], $targetPath);

//Creat an Object
        $Reader = new SpreadsheetReader($targetPath);


// Take an array of sheet's names to be integrated as equipe (equipement)
        $sheetName = $Reader->Sheets();
//Count the number of sheets into the file
        $sheetCount = count($Reader->sheets());
        for ($i = 0; $i < $sheetCount; $i++) {
            $Reader->ChangeSheet($i);
//Create a key to pass the first ligne, the colomn's titles ligne
            $key = 0;
            foreach ($Reader as $Row) {
                if ($key == 0) {
                    $key = 1;
                } else {
		    $num_affaire =[];
		    if (isset($Row[0])) {
		   	$num_affaire = $Row[0];
		    }
                    $nom_client = [];
                    if (isset($Row[1])) {
                        $nom_client = $Row[1];
                    }
                    $titre_affaire = [];
                    if (isset($Row[2])) {
                        $titre_affaire = $Row[2];
                    }
                    $plan_client = [];
                    if (isset($Row[4])) {
                        $plan_client = $Row[4];
                    }
                    $repere = [];
                    if (isset($Row[5])) {
                        $repere = $Row[5];
                    }
                    $num_folio = [];
                    if (isset($Row[6])) {
                        $num_folio = $Row[6];
                    }
                    $designation = [];
                    if (isset($Row[8])) {
                        $designation = $Row[8];
                    }
                    $reference = [];
                    if (isset($Row[9])) {
                        $reference = $Row[9];
                    }
                    $fabricant = [];
                    if (isset($Row[10])) {
                        $fabricant = $Row[10];
                    }
//when the next line is empty, check only the first two colomns
                    if (!empty($nom_client) || !empty($titre_affaire)) {
// Start to import data into the database
// Check if the client already exists in bdd 
                        $sql_client_check = "SELECT id FROM client WHERE client= '" . $nom_client . "'";
                        $stmt_client_check = $bdd->prepare($sql_client_check);
                        $stmt_client_check->execute();
                        $id_client = $stmt_client_check->fetch(PDO::FETCH_ASSOC)['id'];

// If client does not exist creat a new one 
                        if (!isset($id_client)) {
                            $sql_new_client = "INSERT INTO client (id, client) VALUE (NULL, ?)";
                            $stmt_new_client = $bdd->prepare($sql_new_client);
                            $id_new_client = $bdd->lastInsertId();
                            $id_client = $id_new_client;
                            if (!$stmt_new_client->execute(array($nom_client))) {
                                echo "<p>Erreur SQL</p>";
                                echo $sql_new_client;
                                print_r($stmt_new_client->errorInfo());
                                die();
                            }
                        }
// Check if num affaire exists dans la bdd
                        $sql_affaire_check = "SELECT id FROM affaire WHERE num_plan= '" . $plan_client . "'";
                        $stmt_affaire_check = $bdd->prepare($sql_affaire_check);
                        $stmt_affaire_check->execute();
                        $id_affaire_check = $stmt_affaire_check->fetch(PDO::FETCH_ASSOC)['id'];
                        $id_affaire = $id_affaire_check;

                        $sql_client = "SELECT id FROM client WHERE client= '" . $nom_client . "'";
                        $stmt_client = $bdd->prepare($sql_client);
                        $stmt_client->execute();
                        $id_client = $stmt_client->fetch(PDO::FETCH_ASSOC)['id'];
// If num affaire does not existe -> creet a new one
                        if (!isset($id_affaire)) {
                            $sql_new_affaire = "INSERT INTO affaire (id, num_affaire, num_plan, titre_affaire, id_client) VALUE (NULL, ?, ?, ?, ?)";
                            $stmt_new_affaire = $bdd->prepare($sql_new_affaire);
                            $id_new_affaire = $bdd->lastInsertId();
                            $id_affaire = $id_new_affaire;
                            if (!$stmt_new_affaire->execute(array($num_affaire, $plan_client, $titre_affaire, $id_client))) {
                                echo "<p>Erreur SQL</p>";
                                echo $sql_new_affaire;
                                print_r($stmt_new_affaire->errorInfo());
                                die();
                            }
                        }
// Check if the equipement exists
                        $sql_equipe_check = "SELECT id FROM equipe WHERE titre_equipe= '" . $sheetName[$i] . "'";
                        $stmt_equipe_check = $bdd->prepare($sql_equipe_check);
                        $stmt_equipe_check->execute();
                        $id_equipe_check = $stmt_equipe_check->fetch(PDO::FETCH_ASSOC)['id'];

                        $sql_affaire_check = "SELECT id FROM affaire WHERE num_plan= '" . $plan_client . "'";
                        $stmt_affaire_check = $bdd->prepare($sql_affaire_check);
                        $stmt_affaire_check->execute();
                        $id_affaire = $stmt_affaire_check->fetch(PDO::FETCH_ASSOC)['id'];


// If equipement does not exist $id_equipe_check = NULL -> creat a new one
                        if (!isset($id_equipe_check)) {
                            $sql_new_equipe = "INSERT INTO equipe (id, titre_equipe, id_affaire) "
                                    . "VALUE (NULL, ?, ?)";
                            $stmt_new_equipe = $bdd->prepare($sql_new_equipe);
                            $id_new_equipe = $bdd->lastInsertId();
                            if (!$stmt_new_equipe->execute(array($sheetName[$i], $id_affaire))) {
                                echo "<p>Erreur SQL</p>";
                                echo $sql_new_equipe;
                                print_r($stmt_new_equipe->errorInfo());
                                die();
                            }
                        } else {
// Check if the existing equipe has the curent id_affaire
                            $sql_equipe_check_aff = "SELECT id FROM equipe WHERE titre_equipe= '" . $sheetName[$i] . "' AND "
                                    . "id_affaire= " . $id_affaire;

                            $stmt_equipe_check_aff = $bdd->prepare($sql_equipe_check_aff);
                            $stmt_equipe_check_aff->execute();
                            $id_equipe_check_aff = $stmt_equipe_check_aff->fetch(PDO::FETCH_ASSOC)['id'];
                            $id_new_equipe_aff = $bdd->lastInsertId();
                            if (!isset($id_equipe_check_aff)) {
                                $sql_new_equipe_aff = "INSERT INTO equipe (id, titre_equipe, id_affaire) "
                                        . "VALUE (NULL, ?, ?)";
                                $stmt_new_equipe_aff = $bdd->prepare($sql_new_equipe_aff, $id_affaire);
                                $id_new_equipe_aff = $bdd->lastInsertId();
                                if (!$stmt_new_equipe_aff->execute(array($sheetName[$i], $id_affaire))) {
                                    echo "<p>Erreur SQL</p>";
                                    echo $sql;
                                    print_r($stmt_new_equipe->errorInfo());
                                    die();
                                }
                            }
                        }
// Check if the fabricant exists
                        $sql_fabricant_check = "SELECT id FROM fabricant WHERE nom= '" . $fabricant . "'";
                        $stmt_fabricant_check = $bdd->prepare($sql_fabricant_check);
                        $stmt_fabricant_check->execute();
                        $id_fabricant_check = $stmt_fabricant_check->fetch(PDO::FETCH_ASSOC)['id'];

// If fabricant does not exist -> creat a new one
                        if (!isset($id_fabricant_check)) {
                            $sql_new_fabricant = "INSERT INTO fabricant (id, nom) "
                                    . "VALUE (NULL, ?)";
                            $stmt_new_fabricant = $bdd->prepare($sql_new_fabricant);
                            $id_new_fabricant = $bdd->lastInsertId();

                            if (!$stmt_new_fabricant->execute(array($fabricant))) {
                                echo "<p>Erreur SQL</p>";
                                echo $sql;
                                print_r($stmt_new_fabricant->errorInfo());
                                die();
                            }
                        }

// Import Excel into table "stock"
                        /*
                          $sql_affaire = "SELECT id FROM affaire WHERE num_affaire= '" . $plan_client . "'";
                          $stmt_affaire = $bdd->prepare($sql_affaire);
                          $stmt_affaire->execute();
                          $id_affaire = $stmt_affaire->fetch(PDO::FETCH_ASSOC)['id'];
                         */
                        $sql_fabricant_check = "SELECT id FROM fabricant WHERE nom= '" . $fabricant . "'";
                        $stmt_fabricant_check = $bdd->prepare($sql_fabricant_check);
                        $stmt_fabricant_check->execute();
                        $id_fabricant = $stmt_fabricant_check->fetch(PDO::FETCH_ASSOC)['id'];

                        $sql_equipe_check2 = "SELECT id FROM equipe WHERE titre_equipe= '" . $sheetName[$i] . "'";
                        $stmt_equipe_check2 = $bdd->prepare($sql_equipe_check2);
                        $stmt_equipe_check2->execute();
                        $id_equipe = $stmt_equipe_check2->fetch(PDO::FETCH_ASSOC)['id'];

			$saisi_par = $_SESSION["user"]["user_id"];
           //$saisi_par = $_SESSION["user"]["id_user"];

                        $sql_nomenclature = "INSERT INTO stock (id, id_equipe, "
                                . "repere, folio, reference, id_fabricant, designation, saisi_par, date_saisi) "
                                . "VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NOW())";
                        $stmt_stock = $bdd->prepare($sql_nomenclature);
                        $id = $bdd->lastInsertId();

                        if (!$stmt_stock->execute(array($id_equipe, $repere, $num_folio, $reference, $id_fabricant, $designation, $saisi_par))) {
                            echo "<p>Erreur SQL</p>";
                            echo $sql;
                            print_r($stmt_stock->errorInfo());
                            die();
                        }
                    }
                }
            }
        }
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
}
header("location:index.php");
die();
