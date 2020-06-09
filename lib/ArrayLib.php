<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Arrays utilities
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */
 
namespace OpenAdmin\Library;

class ArrayLib {

	public static function clean($array) {
		
		return array_filter($array, function($item) {
			return !empty($item);
		});
	}
	
	public static function trim($array) {
		
		return array_map(function($item) {
			return trim($item);
		}, $array);
	}
	
}
