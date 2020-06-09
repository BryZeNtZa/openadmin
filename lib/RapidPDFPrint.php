<?php
/**
 * Project : OLYMPIA KIT.
 * File Author : BryZe NtZa
 * File Description : Application 
 * Date : Mai 2018.
 * Copyright XDEV WORKGROUP
 * */

require_once('lib/mpdf/mpdf.php');

$direction = 'ltr';

// Récupération du fichier de style pour l'impression
$filename = 'www/css/print-pdf.css';

$fp	= fopen($filename, 'r');
$contenu = fread($fp, filesize($filename)).$contenu;
fclose($fp);

$mPDF = new mPDF('utf-8','A4','','',10,10,10,15,0,8);

$mPDF->SetDirectionality($direction);

$footer_mentions = 'Powered by XDEV WORKGGROUP';

$footer = array (
	'odd' => array (
		'L' => array ('content' => $footer_mentions, 'font-size' => 8,'font-style' => '','font-family' => 'arial','color'=>'#000000'),
		'C' => array ('content' => '', 'font-size' => 8, 'font-style' => '', 'font-family' => 'arial','color' => '#000000'),
		'R' => array ('content' => date('d/m/Y H:i'),'font-size' => 8,'font-style' => '','font-family' => 'arial','color' => '#000000'),
		'line' => 1,
	),
);
		
$mPDF->SetFooter($footer, '');

$mPDF->WriteHTML($contenu);

$mPDF->Output();
 
?>
