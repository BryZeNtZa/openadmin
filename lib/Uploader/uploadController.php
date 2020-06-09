<?php
/*
 * Project : OPEN ADMIN
 * Description : Files upload controller
 * Class Author : BryZe NtZa
 * Date : 13 DEC 2014.
 * Copyright XDEV WORKGROUP
 */	
 
session_start();

//perform only if session exist
if(isset($_SESSION['GADAFICPROSECONDARY'])) {
	
	$_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] = 
	( !isset($_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS']) )
		? 0 : $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'];
	
	$ses_id = session_id();
	
	require_once 'Uploader.php';
	
	$_SESSION['uploadcounter'] = ( !isset($_SESSION['uploadcounter']) ) ? 0 : $_SESSION['uploadcounter']+1;
	
	$target 	= $_POST['target'];
	$mediaType  = $_POST['mediaType'];
	$itemID  = isset($_POST['itemID']) ? $_POST['itemID'] : 0;

	$uploader = new Uploader($target, $mediaType, $itemID);
	
	echo json_encode( $uploader->uploadArrayBack() );

}

?>