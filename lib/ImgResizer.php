<?php

namespace OpenAdmin\Library;

class ImgResizer {
   
    private $originalFile = '';
    private $ext 		  = '';
    private $userResizeTimeStamp = '';
	
    private $resizedir 	  = '';
    private $uploaddir 	  = '';
	
	public function __construct($originalFile, $ext, $itemID=1, $target='utilisateur') {
        
		$this->userResizeTimeStamp = date("dmyhis");
		
		$this->originalFile = str_replace('../../', './', $originalFile);
        $this->ext 		  = $ext;
		
		switch ($target) {
			case 'utilisateur' :
				$this->resizedir = './ressources/uploads/utilisateurs/resized/UTL'.$itemID.'IMG'; 
				$this->uploaddir = './ressources/photos/utilisateurs/UTL'.$itemID.'IMG'; 
			break;
			case 'eleve' :
				$this->resizedir = './ressources/uploads/produits/resized/ELE'.$itemID.'IMG'; 
				$this->uploaddir = './ressources/photos/produits/ELE'.$itemID.'IMG'; 
			break;
		}
		
    }
    
	public function resize() {

		$uploaddir = '';
		
		$src = '';
		
		if( strtolower($this->ext) == 'jpg' ) $src = imagecreatefromjpeg($this->originalFile);
		if( strtolower($this->ext) == 'jpeg') $src = imagecreatefromjpeg($this->originalFile);
		if( strtolower($this->ext) == 'png' ) $src = imagecreatefrompng($this->originalFile);
		if( strtolower($this->ext) == 'gif' ) $src = imagecreatefromgif($this->originalFile);
		
		list($width, $height) = getimagesize($this->originalFile);
		
		if($width > $height){
			$scale1 = 50/$width;
			$scale2 = 250/$width;
			$scale4 = 800/$width;
		}else{
            $scale1 = 50/$height;
            $scale2 = 250/$height;
            $scale4 = 800/$height;
        }
 		
        $h1 = ceil($height * $scale1);
        $w1 = ceil($width  * $scale1);
        $h2 = ceil($height * $scale2);
        $w2 = ceil($width  * $scale2);
        $h4 = ceil($height * $scale4);
        $w4 = ceil($width  * $scale4);
 
		$dimensions = array('w1'=>$w1,'h1'=>$h1,'w2'=>$w2,'h2'=>$h2,'w4'=>$w4,'h4'=>$h4);
		

        $tmp1 = imagecreatetruecolor($w1, $h1);
        $tmp2 = imagecreatetruecolor($w2, $h2);
        $tmp4 = imagecreatetruecolor($w4, $h4);
        
		imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $w1, $h1, $width, $height);
        imagecopyresampled($tmp2, $src, 0, 0, 0, 0, $w2, $h2, $width, $height);
        imagecopyresampled($tmp4, $src, 0, 0, 0, 0, $w4, $h4, $width, $height);

		imageinterlace($tmp1, 1);
        imageinterlace($tmp2, 1);
        imageinterlace($tmp4, 1);

        if( strtolower($this->ext) == 'jpg' || strtolower($this->ext) == 'jpeg' ){
			imagejpeg($tmp1, $this->resizedir.$this->userResizeTimeStamp.'THB1XD.jpg', 82); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
			imagejpeg($tmp2, $this->resizedir.$this->userResizeTimeStamp.'THB2XD.jpg', 82); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
			imagejpeg($tmp4, $this->resizedir.$this->userResizeTimeStamp.'THB3XD.jpg', 82); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
        }
        if( strtolower($this->ext) == 'png'){
			imagejpeg($tmp1, $this->resizedir.$this->userResizeTimeStamp.'THB1XD.jpg', 82); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
			imagejpeg($tmp2, $this->resizedir.$this->userResizeTimeStamp.'THB2XD.jpg', 82); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
			imagejpeg($tmp4, $this->resizedir.$this->userResizeTimeStamp.'THB3XD.jpg', 82); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
        }
        if( strtolower($this->ext) == 'gif'){
			imagejpeg($tmp1, $this->resizedir.$this->userResizeTimeStamp.'THB1XD.jpg', 82); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
			imagejpeg($tmp2, $this->resizedir.$this->userResizeTimeStamp.'THB2XD.jpg', 82); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
			imagejpeg($tmp4, $this->resizedir.$this->userResizeTimeStamp.'THB3XD.jpg', 82); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
        }
		
		unlink($this->originalFile);
		
		return $dimensions;
	}
	
	public function moveResizedImages($imageID){
		rename($this->resizedir.$this->userResizeTimeStamp.'THB1XD.jpg', $this->uploaddir.$imageID.'THB1XD.jpg');
		rename($this->resizedir.$this->userResizeTimeStamp.'THB2XD.jpg', $this->uploaddir.$imageID.'THB2XD.jpg');
		rename($this->resizedir.$this->userResizeTimeStamp.'THB3XD.jpg', $this->uploaddir.$imageID.'THB3XD.jpg');
	}
	
	public function deleteResizedImages(){
		unlink($this->resizedir.$this->userResizeTimeStamp.'THB1XD.jpg');
		unlink($this->resizedir.$this->userResizeTimeStamp.'THB2XD.jpg');
		unlink($this->resizedir.$this->userResizeTimeStamp.'THB3XD.jpg');
	}
}
?>