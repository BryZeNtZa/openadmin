<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : OpenAdmin Datas Architecture
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Architecture\BigData;

abstract class BigTable {

	protected BigData $bigData;
	protected int $modelID;

	/*All the databases of the table*/
	protected array $databases;

	/*Model of the table*/
	protected array $model;

	/*All tables of the current model*/
	protected array $tables;

	/*Model server informations*/
	protected array $server;

	public function __construct(BigData $bigData, int $modelID) {
		$this->bigData = $bigData;
		$this->modelID = $modelID;
	}

	public function getModelID(): int {
		return $this->modelID;
	}

	public function setDatabases($databases): void {
		$this->databases = $databases;
	}

	public function find($str) {
		$this->architecture->find();
	}
	
	public function getTables() {
		
	}
	
	private function getPDO($dsn, $userName, $passWd): void {
		try {
			$this->pdo = new \PDO($dsn, $userName, $passWd);
		} catch ( \PDOException  $e ){
			die('Big Database Error:' . $e->getMessage());
		}
	}
	
	private function getDSN($vendor, $host, $dbname) {
		if($vendor === 'mysql') {
			return $vendor.':host='.$host.';dbname='.$dbname;
		} else {
			die ('ERROR: Cannot build DSN. Vendor <b>'.$vendor.'</b> is not yet available !!!');
		}
	}

}
