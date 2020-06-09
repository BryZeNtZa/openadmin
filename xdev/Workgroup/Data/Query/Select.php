<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : SQL Queries Builder
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Data\Query;

use Xdev\Workgroup\Data\Query\Part\Where;
use Xdev\Workgroup\Data\Query\Part\QueryFilter;

class Select extends Query {
	
	const _SELECT = 'SELECT ';
	const _FROM = 'FROM ';
	const _WHERE = 'WHERE ';

	protected Select $select = null;

	public Where $where = null;
	public QueryFilter $filter = null;

	protected string $fields = '*';

    public function __construct(string $tableName, string $fields='*') {
        parent::__construct($tableName, self::_SELECT);
		$this->fields ??= $fields;
    }
	
	public function where(array $where) {
		$this->where->equals($where);
		return $this;
	}
	
	public function __call($function, $args) {
		method_exists($this->where, $function) 
		? $this->where->$function($args) 
		: $this->filter->$function($args);
		return $this;
	}

	public function build(): void { 
		$this->sql = self::_SELECT . $this->fields . self::_FROM . $this->tableName;
		$this->sql .= $this->where ?: $this->where->render();
		$this->sql .= $this->filter ?: $this->filter->render();
	}

	public function run(): array {
		$this->sql ?? $this->build();
		$stm = $this->pdo->prepare($this->sql);
		$stm->execute($this->bindings??null);
		return $stm->fetchAll();
	}

}
