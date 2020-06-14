<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : SQL Query abstract model class
 * Date : May 30th 2020
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Data;
 
abstract class Entity {

    protected $attributes = array();
    protected $mappings = array();
	
	public function __construct() {
		
	}
	
	public function __get(string $attribute) {
		
	}
	
	public function __set(string $attribute, string $value) {
		$this->attributes[$attribute] = $value;
	}

	public function __set(string $attribute, string $value) {
		$this->attributes[$attribute] = $value;
	}

	public function hydrate(array $datas) {
		
	}
	
}
