<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : SQL Filter Part
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Data\Query\Part;
 
class QueryFilter {

	const ASC = 'ASC';
	const DESC = 'DESC';

	const GROUP_BY = 'GROUP BY ';
	const ORDER_BY = 'ORDER BY ';
	const LIMIT = 'LIMIT ';

	protected array $group = null;
	protected array $order = null;
    protected array $limit = null;

	public function order(array $order): QueryFilter {
		$this->order = $order;
		return $this;
	}
	
	public function limit(array $limit): QueryFilter {
		$this->limit = $limit;
		return $this;
	}

	public function group(array $group): QueryFilter {
		$this->group = $group;
		return $this;
	}
	
	public function render(): string {

		$sqlString = '';
		
		$i = 0;
		if($this->group) {
			$sqlString = self::GROUP_BY;
			foreach($this->group as $grp) {
				$sqlString .= $i>0 ?? ', ';
				$sqlString .= $grp[0] . ' ' . $grp[1]; $i++;
			}
		}
		$i = 0;
		if($this->order) {
			$sqlString = self::ORDER_BY;
			foreach($this->order as $ord) {
				$sqlString .= $i>0 ?? ', ';
				$sqlString .= $ord[0] . ' ' . $ord[1]; $i++;
			}
		}
		
		if($this->limit) {
			$sqlString = self::LIMIT;
			$sqlString .= $this->limit[0] . ', ' . $this->limit[1];
		}
		
		return $sqlString;
	}
}
