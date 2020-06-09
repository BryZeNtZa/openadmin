<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Services class to access remote datas
 * Date : May 30th 2020
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Data;
 
Class DataUtils {
	
	public static function getEntity($string){
		return include './dao/entities/'.$string.'.php';
	}
	
	public static function prepareModel($model, $datas){
		$record = array_intersect_key($model, $datas);
		foreach ($record as $column => $valeur) $record[$column] = $datas[$column];
		return $record;
	}
	
	public static function hydratate($model, $datas){
		
		foreach ($datas as $column => $valeur){
			if( isset( $model[$column] ) ) $model[$column]['valeur'] = $valeur;
		}
		return $model;
	}
	
    public static function protectStr($str): string {
		$search = ['"','\'', '\\'];
		$replace = ['&quot;','&quot;', '&slash'];

		return '"' . str_replace($search, $replace, $str) . '"';
    }

}
