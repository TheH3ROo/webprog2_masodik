<?php
// A TCPDF 6. példájának a segítségével

try {
    //ob_start();
	$dbh = new PDO('mysql:host=localhost;dbname=masodik', 'root', '',
				array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

	$sql = "SELECT * FROM felhasznalok";     
	$sth = $dbh->query($sql);
	$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
}
	catch (PDOException $e) {
	echo "Hiba: ".$e->getMessage();
}

// Include the main TCPDF library
ob_start();
require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Web-programozás II');
$pdf->SetTitle('FELHASZNÁLÓK');
$pdf->SetSubject('Web-programozás II - 3. Labor - TCPDF');
$pdf->SetKeywords('TCPDF, PDF, Web-programozás II, Labor3');

// set default header data
$pdf->SetHeaderData("nje.png", 25, "FELHASZNÁLÓK LISTÁJA", "Web-programozás II\n3. Labor\n".date('Y.m.d',time()));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// create the HTML content
$html  = '
<html>
	<head>
		<style>
			table {border-collapse: collapse;}
			th {font-weight: border: 1px solid red; text-align: center;}
			td {border: 1px solid blue;}
		</style>
	</head>
	<body>
		<h1 style="text-align: center; color: blue;">FELHASZNÁLÓK</h1>
		<table>
			<tr style="background-color: red; color: white;">
			<th style="width: 5%;">&nbsp;<br>&nbsp;<br>&nbsp;</th>
			<th style="width: 20%;">&nbsp;<br>CSALÁDI NÉV</th>
			<th style="width: 20%;">&nbsp;<br>UTÓNÉV</th>
			<th style="width: 20%;">&nbsp;<br>BEJELENTKEZÉS</th>
			<th style="width: 35%;">&nbsp;<br>JELSZÓ</th>
			</tr>
';
			$i=1;
foreach($rows as $row) {
	if($i)
		$html .= '
			<tr style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 255);">
		';
	else					
		$html .= '
			<tr style="background-color: rgb(0, 0, 255); color: rgb(255, 255, 255);">
		';
	$j=0;
	foreach($row as $cell) {
		if($j==0)
			$html .= '
				<td style="text-align: right; width: 5%;">
			';
		else if($j < 4)
			$html .= '
				<td style="text-align: left; width: 20%;">
			';
		else if($j == 4)
			$html .= '
				<td style="text-align: left; width: 35%;">
			';
		$html .= $cell;
		$html .= '
				</td>
		';
		$j++;
	}
	$html .= '
			</tr>
	';
	$i = !$i;
}
$html .= '
		</table>
	<body>
</html>';

$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
ob_clean();
//ob_flush();
$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'teszt.pdf', 'I');
exit;