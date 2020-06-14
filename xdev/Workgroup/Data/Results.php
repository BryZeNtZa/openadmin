<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : SQL Query abstract model class
 * Date : May 30th 2020
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Data;
 
class Results {

	// protected Entity[] $datas;
    protected $datas = array();
	
	public function find(array $criterias) {
		
	}

	public function first() {
		$n = count($this->datas);
		return ($n != 0) ? $this->datas[0] : null;
	}

	public function last() {
		$n = count($this->datas);
		return ($n != 0) ? $this->datas[$n-1] : null;
	}
	
	public function datas(): array {
		return $this->datas;
	}
}
