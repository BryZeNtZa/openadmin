<?php
require_once '../FM_Localconfig.php';

$uploadImgDesList	= $_POST['uploadImgDesList'];
$target 			= $_GET['from'];
$mediaType 			= $_GET['mediaType'];

$fileDir = '';
	$i = 0;
	if( $mediaType == 0 ){ //Images
		
		switch($target){
			case 'account' :
				$fileDir = '../../' . _FMDIR . 'Pictures/tempweb/Accounts/';
			break;
			case 'user' :
				$fileDir = '../../' . _FMDIR . 'Pictures/tempweb/Users/';
			break;
			case 'product' :
				$fileDir = '../../' . _FMDIR . 'Pictures/tempweb/Products/';
			break;
		}

		foreach($uploadImgDesList as $key => $fileName){
			$filePath = $fileDir . $fileName;
			if( file_exists($filePath) ) { $i++; unlink($filePath); }
		}
		
	}
	elseif( $mediaType == 1 ){ //Videos
		//Mettre à jour le fmTempDir

	}
	elseif( $mediaType == 2 ){ //Audios
		
		$fileDir = '../../' . _FMDIR . 'Pictures/tempweb/Accounts/Audios/';
		foreach($uploadImgDesList as $key => $fileName){
			$filePath = $fileDir . $fileName;
			if( file_exists($filePath) ) { $i++; unlink($filePath); }
		}
	
	}
	echo $i . ' Files deleted !';
?>
