<?php

require_once 'lib/ImgResizer.php';

$tempDir 	  = $_GET['dir'];
$fileTempName = $_GET['name'];

$fileTempURI 	= $tempDir.$fileTempName;

$utilisateurTable  = new OpenAdmin\DAO\AppTable('utilisateur');
$imagesTable  	  = new OpenAdmin\DAO\AppTable('image');

$ext = pathinfo($fileTempURI, PATHINFO_EXTENSION);

$itemID = $_SESSION['GADAFICPROSECONDARY']['id'];
$img    = new ImgResizer($fileTempURI, $ext, $itemID, 'utilisateur');

$dimensions	= $img->resize();

$affected = 0;

if( !empty($dimensions) ){
	
	$imgDatas = array('target'=>1, 'parentID'=>0, 'itemID'=>$itemID, 'date'=>date("Y-m-d h:i:s"));
	
	$insertedID = $imagesTable->insertDatas( array_merge($imgDatas, $dimensions) );
	$img->moveResizedImages($insertedID);
	
	$affected = $utilisateurTable->updateRows(array('imageID'=>$insertedID), 'id='.$_SESSION['GADAFICPROSECONDARY']['id']);
	$_SESSION['GADAFICPROSECONDARY']['imageID'] = $insertedID;

}
