<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : SQL Query abstract model class
 * Date : May 30th 2020
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Data;
 
abstract class Query {

    protected string $type = 'SELECT';
    protected string $tableName = null;

    protected string $sql = null;

    protected array $bindings = null;
    protected \PDO $pdo;

    public function __construct(string $tableName, string $type=null) {
        $this->tableName = $tablename;
        $this->type ??= $type;
    }

	public abstract function build(): void;
	public abstract function run(): boolean|int|array|Results;

	public function sql(): string {
		return $this->sql;
	}
}
