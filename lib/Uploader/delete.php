<?php

	$fileName = $_POST['file']['name'];
	$fileDir  = $_POST['file']['dir'];
	
	$filePath = $fileDir . $fileName;
	
	if( file_exists($filePath) ) unlink($filePath);
	
	echo 'Deleted File '.$filePath;
?>