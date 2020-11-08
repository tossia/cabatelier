<?php
include("inc/config.inc");

if (!is_logged()) {
    header("location:admin/login.php");
    die();
}
// Call pdf creator livrary 
require('vendor/pdf/tfpdf.php'); // fpdf library supported the French lettres
//Select what you want to put into the header
$affaire = "SELECT affaire.num_affaire, affaire.num_plan, titre_affaire, client.client as client "
        . "FROM affaire "
        . "LEFT JOIN client ON affaire.id_client=client.id "
        . "WHERE num_affaire = '" . $_SESSION['num_affaire'] . "'";
$stmt = $bdd->prepare($affaire);
$stmt->execute();
$client = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['num_plan'] = $client['num_plan'];

// Page footer
class PDF extends tFPDF {

    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('DejaVu', 'O', 8);
        // Page number
        $x = $this->GetX();
        $y = $this->GetY();
        $this->Cell(95, 8, 'N° schema : ' . $_SESSION['num_plan'], 0, 0, 'L');
        $this->Cell(95, 8, 'Page ' . $this->PageNo() . '/{nb}', 0, 1, 'R');
    }

}

//Create new pdf file
$pdf = new PDF('p', 'mm', 'A4');
// Add font with special caracters
$pdf->AddFont('DejaVu', '', 'DejaVuSans.ttf', true);
$pdf->AddFont('DejaVu', 'B', 'DejaVuSans-Bold.ttf', true);
$pdf->AddFont('DejaVu', 'O', 'DejaVuSans-Oblique.ttf', true);
$pdf->AliasNbPages();

//Add first page with header
$pdf->AddPage();
$pdf->SetAuthor($_SESSION['user']['nom']); //The person who creat pdf file
$pdf->Image('images/logo.png', 10, 5, 0); // Insert a logo

// Header text
$pdf->SetX(50);
$pdf->SetFont('DejaVu', 'B', 14);
$pdf->Cell(80, 10, 'FICHE DE RELEVE', 0, 0, 'C');
$pdf->SetFont('DejaVu', 'B', 10);
$pdf->Cell(10, 10, '', 0, 0, 'C');
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(30, 10, $_SESSION['num_affaire'], 1, 0, 'C');
$pdf->Cell(25, 10, $_SESSION['equipe'], 1, 1, 'C');

$pdf->SetX(40);
$pdf->SetFont('DejaVu', 'B', 12);
$pdf->Cell(100, 10, 'des n° d\'identification des appareils', 0, 0, 'C');

$pdf->SetFont('DejaVu', 'O', 8);
$pdf->Cell(30, 6, 'N° Affaire', 0, 0, 'C');
$pdf->Cell(25, 6, 'N° équipement', 0, 1, 'C');

// Add un empty row
$pdf->Cell(190, 6, '', 0, 1);

//Block with num affaire info
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(95, 6, 'Client : ' . $client['client'], 0, 0, 'L');
$pdf->Cell(95, 6, 'Affaire : ' . $client['titre_affaire'], 0, 1, 'L');
$pdf->SetFont('DejaVu', 'O', 8);
$pdf->Cell(95, 6, 'Customer', 0, 0, 'L');
$pdf->Cell(95, 6, 'Project', 0, 1, 'L');
// Add un empty row
$pdf->Cell(190, 2, '', 0, 1);
// Block Reference documents
$pdf->SetFont('DejaVu', 'B', 9);
$pdf->Cell(94, 6, 'Documents de référence / reference documents', 1, 0, 'L');
$pdf->Cell(2, 6, '', 0, 0);
$pdf->SetFont('DejaVu', '', 9);
$pdf->Cell(32, 6, 'DESIGNATION', 1, 0, 'C');
$pdf->Cell(52, 6, 'REFERENCE', 1, 0, 'C');
$pdf->Cell(10, 6, 'REV', 1, 1, 'C');

$pdf->Cell(32, 6, 'DESIGNATION', 1, 0, 'C');
$pdf->Cell(52, 6, 'REFERENCE', 1, 0, 'C');
$pdf->Cell(10, 6, 'REV', 1, 0, 'C');
$pdf->Cell(2, 6, '', 0, 0);
$pdf->Cell(32, 6, '', 1, 0, 'C');
$pdf->Cell(52, 6, '', 1, 0, 'C');
$pdf->Cell(10, 6, '', 1, 1, 'C');

$pdf->SetFont('DejaVu', 'O', 9);
$pdf->Cell(32, 6, 'Schema éléctrique', 1, 0, 'L');
$pdf->Cell(52, 6, $client['num_plan'], 1, 0, 'L');
$pdf->Cell(10, 6, '', 1, 0, 'C');
$pdf->Cell(2, 6, '', 0, 0);
$pdf->Cell(32, 6, '', 1, 0, 'C');
$pdf->Cell(52, 6, '', 1, 0, 'C');
$pdf->Cell(10, 6, '', 1, 1, 'C');
// Add un empty row
$pdf->Cell(190, 2, '', 0, 1);

// Modification block
$pdf->SetFont('DejaVu', '', 9);
$pdf->Cell(30, 6, 'Date', 1, 0, 'C');
$pdf->Cell(30, 6, 'Emis/Modifié par', 1, 0, 'C');
$pdf->Cell(130, 6, 'Modification', 1, 1, 'C');
$pdf->Cell(30, 6, '', 1, 0, 'C');
$pdf->Cell(30, 6, '', 1, 0, 'C');
$pdf->Cell(130, 6, '', 1, 1, 'C');
$pdf->Cell(30, 6, '', 1, 0, 'C');
$pdf->Cell(30, 6, '', 1, 0, 'C');
$pdf->Cell(130, 6, '', 1, 1, 'C');
$pdf->Cell(30, 6, '', 1, 0, 'C');
$pdf->Cell(30, 6, '', 1, 0, 'C');
$pdf->Cell(130, 6, '', 1, 1, 'C');

//Insert colomns from data base
//Column widths
$col_width = array(30, 30, 40, 45, 45);
//set initial y axis position per page TO SEE!!!
$y_axis_initial = 94;
//print column titles
$pdf->SetFillColor(225, 225, 225);
$pdf->SetFont('DejaVu', 'B', 9);
$pdf->SetY($y_axis_initial);
//$pdf->SetX(20);
$pdf->Cell($col_width[0], 6, 'REPERE', 1, 0, 'L', 0);
$pdf->Cell($col_width[1], 6, 'EMPLACEMENT', 1, 0, 'L', 0);
$pdf->Cell($col_width[2], 6, 'REFERENCE', 1, 0, 'L', 0);
$pdf->Cell($col_width[3], 6, 'FABRICANT', 1, 0, 'L', 0);
$pdf->Cell($col_width[4], 6, 'N° SERIE', 1, 0, 'L', 0);

//Set Row Height
$cellHeight = 6; //normal one-line cell height
//Set la coordinate Y to start the table
$y_axis = $y_axis_initial;
$y_axis = $y_axis + $cellHeight;
//Select the data only for selected equipment
$equipe = "SELECT id from equipe WHERE titre_equipe = '" . $_SESSION['equipe'] . "'";
$stmt = $bdd->prepare($equipe);
$stmt->execute();
$id_equipe = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

//Select the colomns you want to show in your PDF file
$stock = "SELECT id_equipe, repere, emplacement.titre_emplacement as "
        . "emplacement, reference, fabricant.nom as fabricant, num_serie "
        . "FROM stock "
        . "LEFT JOIN emplacement ON stock.id_emplacement=emplacement.id "
        . "LEFT JOIN fabricant ON stock.id_fabricant=fabricant.id "
        . "WHERE num_serie > '' AND id_equipe = " . $id_equipe . " ORDER BY repere";

$stmt = $bdd->prepare($stock);
$stmt->execute();
$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdf->SetFillColor(250, 250, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('DejaVu', '', 10);
$fill = false;

foreach ($result2 as $row) {
    //If the current row is the last one, create new page and print column title
    if (($pdf->GetY()) == 268) {
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $y_axis = 10;

//print column titles for the current page
        $pdf->SetFont('DejaVu', 'B', 9);
        $pdf->SetY($y_axis);

        $pdf->Cell($col_width[0], 6, 'REPERE', 1, 0, 'L', 0);
        $pdf->Cell($col_width[1], 6, 'EMPLACEMENT', 1, 0, 'L', 0);
        $pdf->Cell($col_width[2], 6, 'REFERENCE', 1, 0, 'L', 0);
        $pdf->Cell($col_width[3], 6, 'FABRICANT', 1, 0, 'L', 0);
        $pdf->Cell($col_width[4], 6, 'N° SERIE', 1, 1, 'L', 0);
        //Go to next row
        $y_axis = $y_axis + $cellHeight;
    }
    //Create the variable whiche will be used in the table
    $repere = $row['repere'];
    $emplacement = $row['emplacement'];
    $reference = $row['reference'];
    $fabricant = $row['fabricant'];
    $num_serie = $row['num_serie'];

    $pdf->SetY($y_axis);
    $pdf->SetFillColor(224, 235, 255);
    $pdf->SetFont('DejaVu', '', 10);

    //As the variable "reference" can be longer than colone weight, we need to
    //calculculate how many lines it will take and to use MultiCell option
    if ($pdf->GetStringWidth($reference) < 19) {
        $line = 1;
    } else {
        $textLenght = strlen($reference); //total text lenght of reference column
//print($textLenght);
// echo '<br>';
        $errMargin = 10;        //in case of erreur
        $startChar = 0;         //character start position for each line
        $maxCharacter = 16;      // max character in a line, to be incremented later
        $textArray = array();   //to hold the string to each line
        $tmpString = "";        //to hold the string for a line (temporary)
//put additional space in the string to cut the word before passing to the next line
        $reference = substr_replace($reference, ' ', $maxCharacter, $startChar);

//print($reference);
//echo '<br>';

        while ($startChar < $textLenght) { //loop until the end of the text
            //loop until maxium character reached
            while (
            $pdf->GetStringWidth($tmpString) < ($col_width[2] - $errMargin) && ($startChar + $maxCharacter) < $textLenght) {
                $maxCharacter++;
                $tmpString = substr($reference, $startChar, $maxCharacter);
            }
            //move startChar to next line
            $startChar = $startChar + $maxCharacter;
            //then add it into the array to know how many ine are needed
            array_push($textArray, $tmpString);
            //reset maxChar ans tmpString
            $maxChar = 0;
            $tmpString = "";
        }
        //get number of lines for "refernece"
        $line = count($textArray);
//print($line);
//echo '<br>';

    }
    $cellFinHeight = $line * $cellHeight; //the height of the line

//print($cellFinHeight);
//echo '<br>';

    $pdf->Cell($col_width[0], $cellFinHeight, $repere, 1, 0, 'L', $fill);
    $pdf->Cell($col_width[1], $cellFinHeight, $emplacement, 1, 0, 'L', $fill);
//need to use MultiCell instead of Cell need to manually set xy position for next Cell
//remember the x and y position before writting MultiCell
    $xPos = $pdf->GetX();
    $yPos = $pdf->GetY();
    $pdf->MultiCell($col_width[2], $cellHeight, $reference, 1, 'L', $fill);
//return the position for next cell to this multicell offset the x with multicell width
    $pdf->SetXY($xPos + $col_width[2], $yPos);
    $pdf->Cell($col_width[3], $cellFinHeight, $fabricant, 1, 0, 'L', $fill);
    $pdf->Cell($col_width[4], $cellFinHeight, $num_serie, 1, 1, 'L', $fill);
    //Go to next row
    $y_axis = $y_axis + $cellFinHeight;

    $fill = !$fill;
}

//Send file, give the name to the PDF file
//"D" - the file will be download, if "I" the file will be open in the navigation window
$pdf->Output("" . $_SESSION['num_affaire'] . "_" . $_SESSION['equipe'] . ".pdf", "D");
?>