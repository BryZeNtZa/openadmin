<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application utilities functions
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */
 
namespace OpenAdmin\Library;
 
Class Util {
	

	public static function parseIntTarget($string) {
		switch ($string) {
			case 'utilisateur' : return 1; break;
			case 'eleve' : return 2; break;
			default : return 1;
		}
	}
	
	public static function parseFolderTarget($string) {
		switch ($string) {
			case 'utilisateur' : return 'utilisateurs'; break;
			case 'eleve' : return 'eleves'; break;
			default : return 'utilisateurs';
		}
	}
	
	public static function parseImgPrefixTarget($string) {
		switch ($string) {
			case 'utilisateur' : return 'UTL'; break;
			case 'eleve' : return 'ELE'; break;
			default : return 'UTL';
		}
	}
	
	public static function loadDatas($filename) {
		return require $filename.'.php';
	}	
	
	public static function arrayKeyFromValue($a, $v) {
		$n = count($a);
		for($i=0; $i<$n; $i++) {
			if( $a[$i] == $v ) return $i;
		}
		return false;
	}
	
	public static function zeroFillCode($code, $n){

		$codeback = $code;

		$nc = strlen($code);
		if($nc <= $n) for($i=0; $i<($n-$nc); $i++) $codeback = '0' . $codeback; 
		
		return $codeback;
	}
	
	public static function randomString($n){

		$sugestions	= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$randomstring = '';
		for ( $i = 1; $i <= $n; $i++){
		  $position = mt_rand(0,61);
		  $randomstring = $randomstring . substr($sugestions,$position,1);
		}
		
		return $randomstring;
	}
			
}
?>