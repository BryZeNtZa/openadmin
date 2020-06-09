<?php
/*
 * Project : OPEN ADMIN
 * Description : -- Files Ulploader --
 * Class Author : BryZe NtZa
 * Date : 13 DEC 2014.
 * Copyright XDEV WORKGROUP
 */	
		 
Class Uploader {
	
	private $target;
	private $mediaType;
	private $fmTempDir;
	private $videosAllowed = array('avi','dat','dvr-ms','ifo','m2ts','m4v','swf','mpeg','mts','mov','mkv','mp4','wmv','3gp','3g2','flv','mpg','gvi','3gp2','3p2','gifv','3gpp2');
	private $audiosAllowed = array('mp3','waw','3gpp','amr','ogg','3ga','wma','m3u');
	
	private $videoMaxSize = 20000000;		
	private $audioMaxSize = 20000000;		
	private $itemID;
	private $uploadArrayBack = array();
	
	public function __construct($target, $mediaType=0, $itemID=0){		
		
		$this->target 	 = $target;
		$this->mediaType = $mediaType;
		$this->itemID 	 = $itemID;
		
		if( $mediaType == 0 ){ //Images
			
			switch($target){
				case 'utilisateur' :
					$this->fmTempDir = '../../ressources/uploads/utilisateurs/';
				break;
				case 'eleve' :
					$this->fmTempDir = '../../ressources/uploads/eleves/';
				break;
			}
			$this->simpleUpload();
		}			
	}
	
	private function simpleUpload(){
		
		global $ses_id;
		
		if( isset($_FILES['uploadfile']) ){
				
			$ret = array();
			
			$error = $_FILES['uploadfile']['error'];
			$timestamp = time();
			
			//You need to handle  both cases
			//If Any browser does not support serializing of multiple files using FormData() 
			if(!is_array($_FILES['uploadfile']['name'])){ //single file
				
				$_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] = $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] + 1;
				
				$ext = pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION);
				
				$fm_temp_file = $this->target . '_'. $this->itemID .'_'. $ses_id . '_' . $timestamp . '_' . $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] . $this->randomString(50) . '.' . $ext; 
				
				move_uploaded_file($_FILES['uploadfile']['tmp_name'], $this->fmTempDir . $fm_temp_file);
				
				$ret[]= array('mutiple'=>'false', 'name' => $fm_temp_file, 'dir' =>$this->fmTempDir);
			}
			else{  //Multiple files, file[]

				$fileCount = count($_FILES['uploadfile']['name']);
				  
				for($i = 0; $i < $fileCount; $i++){
					$_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] = $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] + 1;
					$ext = pathinfo($_FILES['uploadfile']['name'][$i], PATHINFO_EXTENSION);
					$timestamp  = time();
					
					$fm_temp_file = $this->target . '_'. $this->itemID .'_'. $ses_id . '_' . $timestamp . $i . $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] . $this->randomString(50) . '.' . $ext;
					
					move_uploaded_file($_FILES['uploadfile']['tmp_name'][$i], $this->fmTempDir . $fm_temp_file);
					
					$ret[]= array('mutiple'=>'true', 'name' =>$fm_temp_file, 'dir' =>$this->fmTempDir);
				}
			
			}
			$this->uploadArrayBack = $ret;
		}
	}
	
	private function videosUpload(){
		
		global $ses_id;
		
		$ret = array();
		
		if( isset($_FILES['uploadvideo']) ){	

			//You need to handle  both cases
			//If Any browser does not support serializing of multiple files using FormData() 
			if( !is_array($_FILES['uploadvideo']['name']) ){ //single file
			
				if( $_FILES['uploadvideo']['size'] < $this->videoMaxSize ){
			
					$ext = pathinfo($_FILES['uploadvideo']['name'], PATHINFO_EXTENSION);
					
					if( in_array( strtolower($ext), $this->videosAllowed) ){
					
						$timestamp = time();
						$fm_temp_file = $this->target . '_' . $this->itemID . '_video' . $ses_id .'_' . $timestamp . $_SESSION['uploadcounter'] . '.' . $ext; 
						
						move_uploaded_file($_FILES['uploadvideo']['tmp_name'], $this->fmTempDir . $fm_temp_file);
						$ret[] = array('msg' =>'success', 'name' =>$this->fmTempDir . $fm_temp_file, 'res' =>'correct Video Type', 'dir' =>$this->fmTempDir);
					}
					else{
						$ret[]= array('msg' =>'error', 'res' =>'Incorrect Video Type', 'size' =>$_FILES['uploadvideo']['size'], 'name' =>$_FILES['uploadvideo']['name'], 'dir' =>$this->fmTempDir);
					}
				
				}else{
					$ret[]= array('msg' =>'error', 'res' =>'Incorrect file size', 'size' =>$_FILES['uploadvideo']['size'], 'name' =>$_FILES['uploadvideo']['name'], 'dir' =>$this->fmTempDir);
				}
				
			}
			else{  //Multiple files, file[]
			
				$fileCount = count($_FILES['uploadvideo']['name']);
				
				for($i=0; $i < $fileCount; $i++){
					
					if($_FILES['uploadvideo']['size'][$i] < $this->videoMaxSize){
						
						$ext = pathinfo($_FILES['uploadvideo']['name'][$i], PATHINFO_EXTENSION);
						
						if (in_array(strtolower($ext), $this->videosAllowed)){
							
							$_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] = $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] + 1;
							
							$timestamp = time();
							$fm_temp_file = $this->target . '_' . $this->itemID . '_video_' . $ses_id . '_' . $timestamp . $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS']. '_' . $i . '_' . $this->randomString(5) . '.' . $ext; 
							
							move_uploaded_file($_FILES['uploadvideo']['tmp_name'][$i], $this->fmTempDir . $fm_temp_file);
							
							$ret[]= array('msg' =>'success', 'res' =>'good Video Type', 'size' =>$_FILES['uploadvideo']['size'][$i], 'name' =>$this->fmTempDir . $fm_temp_file, 'dir' =>$this->fmTempDir);
						}
						else{
							$ret[]= array('msg' =>'error', 'res' =>'Incorrect Video Type', 'size' =>$_FILES['uploadvideo']['size'][$i], 'name' =>$_FILES['uploadvideo']['name'][$i], 'dir' =>$this->fmTempDir);	
						}
					}else{
						$ret[]= array('msg' =>'error', 'res' =>'Incorrect file size', 'size' =>$_FILES['uploadvideo']['size'][$i], 'name' =>$_FILES['uploadvideo']['name'][$i], 'dir' =>$this->fmTempDir);
					}
				}
				
			}
			//echo json_encode($ret);
			
		}else{
			$ret[]= array('msg' =>'error', 'res' =>'Incorrect file parameter', 'name' =>'', 'dir' =>$this->fmTempDir);
		}
		
		$this->uploadArrayBack = $ret;
		
	} 

	private function audioUpload(){
		
		global $ses_id;
		
		$ret = array();
		
		if( isset($_FILES['uploadaudio']) ){

			$timestamp = time();
			
			//You need to handle  both cases
			//If Any browser does not support serializing of multiple files using FormData() 
			if( !is_array($_FILES['uploadaudio']['name']) ){ //single file
			
				if($_FILES['uploadaudio']['size'] < $this->audioMaxSize){
			
					$ext = pathinfo($_FILES['uploadaudio']['name'], PATHINFO_EXTENSION);
					
					if (in_array(strtolower($ext), $this->audiosAllowed)){
					
						$_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] = $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] + 1;

						$fm_temp_file = $this->target . '_' . $this->itemID . '_audio_' . $ses_id . '_' . $timestamp . '_' . $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS'] . $this->randomString(5) . '.' . $ext; 
						
						move_uploaded_file($_FILES['uploadaudio']['tmp_name'], $this->fmTempDir . $fm_temp_file);
						$ret[] = array('mutiple'=>'false', 'msg' =>'success', 'name' =>$fm_temp_file, 'res' =>'Correct Audio Type', 'dir' =>$this->fmTempDir);
					}
					else{
						$ret[] = array('mutiple'=>'false', 'msg' =>'error', 'res' =>'Incorrect Audio Type', 'name' =>$_FILES['uploadaudio']['type'], 'dir' =>$this->fmTempDir);
					}
				
				}else{
					$ret[] = array('mutiple'=>'false', 'msg' =>'error', 'res' =>'Incorrect file size', 'size' =>$_FILES['uploadaudio']['size'], 'name' =>$_FILES['uploadaudio']['name'], 'dir' =>$this->fmTempDir);
				}
				
			}
			else{  //Multiple files, file[]
			
				$fileCount = count($_FILES['uploadaudio']['name']);
				
				for($i=0; $i < $fileCount; $i++){
					
					if($_FILES['uploadaudio']['size'][$i] < $this->audioMaxSize){
						$ext = pathinfo($_FILES['uploadaudio']['name'][$i], PATHINFO_EXTENSION);
						if(in_array(strtolower($ext), $this->audiosAllowed)){
							$timestamp = time();
							$fm_temp_file = $this->target . '_'. $this->itemID .'_audio_'. $ses_id . '_' . $timestamp . '_' . $_SESSION['GADAFICPROSECONDARY']['NUM_UPLOADS']. '_' . $i . '_' . $this->randomString(5) . '.' . $ext; 
							
							move_uploaded_file($_FILES['uploadaudio']['tmp_name'][$i], $this->fmTempDir . $fm_temp_file);
							$ret[] = array('mutiple'=>'true', 'msg' =>'success', 'res' =>'good Video Type', 'name' =>$fm_temp_file, 'dir' =>$this->fmTempDir);
						}
						else{
							$ret[] = array('mutiple'=>'true', 'msg' =>'error', 'res' =>'Incorrect Video Type', 'name' =>$_FILES['uploadaudio']['name'][$i], 'dir' =>$this->fmTempDir);	
						}
					}else{
						$ret[] = array('mutiple'=>'true', 'msg' =>'error', 'res' =>'Incorrect file size', 'name' =>$_FILES['uploadaudio']['name'][$i], 'dir' =>$this->fmTempDir);
					}
				}
				
			}
			
		}else{
			$ret[] = array('mutiple'=>'unset', 'msg' =>'error', 'res' =>'Incorrect file parameter', 'name' =>'', 'dir' =>$this->fmTempDir);
		}
		
		$this->uploadArrayBack = $ret;
		
	}
	
	public function  uploadArrayBack(){
		return  $this->uploadArrayBack;
	}
		
}
	
?>