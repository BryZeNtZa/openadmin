<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : SQL Where Part
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Data\Query\Part;
 
class Where {
	
	//Sub where
	protected Where $subWhere;
	protected string $subWhereOperation;
	
	// protected Assertion[] $assertions;
	protected array $assertions;
	
	public function equals(array $equals) {
		foreach($equals as $field=>$value) {
			$assertion = new Assertion('equals');
			$assertion->setField($field)
			->setOperator(Assertion::_EQUALS)
			->setValue($value)
			->setOperation(Assertion::_AND);
			array_push($this->assertions, $assertion);
		}
	}

    public function between(array $betweens) {
		foreach($betweens as $field=>$values) {
			$assertion = new Assertion('between');
			$assertion->setField($field)
			->setOperator(Assertion::_BETWEEN)
			->setLeftValue($value[0])
			->setRightValue($value[1])
			->setOperation(Assertion::_AND);
			array_push($this->assertions, $assertion);
		}
    }

	public function join(Where $where): Where {
		return $this;
	}
	
	public function in(array $in) {
		
	}
	
	public function not_in(array $not_in) {
		
	}
	
	public function render(): string {
		$whereStr = '';
		foreach($this->assertions as $assertion) {
			$whereStr .= $assertion->render();
		}
		
		//Sub where rendering
		if($this->subWhere) {
			$whereStr = '(' . $whereStr;
			$whereStr .= $this->subWhereOperation . '(' . $this->subWhere->render() . ')';
			$whereStr = $whereStr . ')';
		}
	
		return $whereStr;
	}
}
