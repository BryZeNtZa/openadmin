<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Strings utilities
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */
 
namespace OpenAdmin\Library;
 

class StringLib {
	
	private static $_delimiter = '#';

	private static function _normalize($pattern) {
		return self::$_delimiter.trim($pattern, self::$_delimiter).self::$_delimiter;
	}
	
	public static function getDelimiter() {
		return self::$_delimiter;
	}
	
	public static function setDelimiter($delimiter) {
		self::$_delimiter = $delimiter;
	}
	
	public static function match($string, $pattern) {
		
		preg_match_all(self::_normalize($pattern), $string, $matches, PREG_PATTERN_ORDER);
		
		if (!empty($matches[1])) {
			return $matches[1];
		}
		if (!empty($matches[0])) {
			return $matches[0];
		}
		
		return null;
	}
	
	public static function split($string, $pattern, $limit = null) {
		$flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE;
		return preg_split(self::_normalize($pattern), $string, $limit, $flags);
	}
	
	public static function randomString($n){

		$sugestions	  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$randomstring = '';
		for ($i=1; $i <= $n; $i++){
		  $position = mt_rand(0,61);
		  $randomstring = $randomstring . substr($sugestions,$position,1);
		}
		return $randomstring;
	}
	
	public static function strEncode($str){
		return utf8_encode($str);
	}
	
}
