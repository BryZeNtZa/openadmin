<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : SQL Where Part
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Data\Query\Part;
 
class Assertion {

	const _EQ = '=';
	const GT = '>';
	const _GT = '>=';
	const LT = '<';
	const _LT = '<=';

	const _AND = 'AND';
	const _OR = 'OR';
	
	protected $op;

	protected string $sql = '';
	
    public function __construct() {
        $this->tableName = $tablename;
        $this->type ??= $type;
    }
	
	public function eq(array $equals) {
		
		return $this;
	}
	
	public function gt($a, $b) {
		
		return $this;	
	}

	public function lt($a, $b) {
		
		return $this;
	}
	
	public function _gt($a, $b) {
		
		return $this;
	}

	public function _lt($a, $b) {
		
		return $this;
	}

    public function between(array $between) {
		
		return $this;
    }
	
	public function in(array $in) {
		
		return $this;
	}
	
	public function not_in(array $not_in) {
		
		return $this;
	}
	
	public function render(): void {
		
	}
}
