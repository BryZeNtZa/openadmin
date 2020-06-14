<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : SQL Query abstract model class
 * Date : May 30th 2020
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Data\Entity\Business;
use Xdev\Workgroup\Data\Entity;
 
class User extends Entity {

    protected $attributes = array();

	public __construct() {
		
	}

	public __get(string $attribute) {
		
	}

	public __set(string $attribute, string $value) {
		$this->attributes[$attribute] = $value;
	}

}
