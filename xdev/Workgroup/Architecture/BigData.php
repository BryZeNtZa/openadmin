<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : OpenAdmin Datas Architecture
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Architecture;

use Xdev\Workgroup\Architecture\Query;
 
class BigData {

	CONST DB_ = 'openadmin_';
	CONST _CFGS = '/configs/configs.php';

	private array $configs;
	private \PDO $pdo;
	private $options = array(
		\PDO::ATTR_EMULATE_PREPARES => false, 
		\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);

	public function __construct() {
		$this->configs = require dirname(dirname(__FILE__)) . _CFGS;
		$this->init();
	}

	public function getBigTable($bigTableClass) {
		$table = new $bigTableClass($this);
		
		// Set databases
		$table->setDatabases( $this->getDatabases( $table->getModelID() ) );
		
		// Set model
		$table->setModel( $bigData->getModel( $table->getModelParam('id') ) );

		// Set attributes
		$table->setAttributes( $bigData->getTableAttributes( $table->getModelParam('id') ) );
		
		// Load tables
		$table->setUnitTables( $bigData->loadUnitTables( $table->getModelParam('id') ) );
		
		$table->setDataAccessObject(
			$this->getPDO(
				$this->getDSN(
					$table->getBDParam('vendor'), 
					$table->getBDParam('host'), 
					self::DB_ . $table->getBDParam('dbname')
				), 
				$table->getBDParam('root'), 
				$table->getBDParam('passwd')
			)
		);

		// Big table class to be return
		$bigtable = new $table->getBigTableClass()();
		$bigtable->setArchitecture($table);

		return $bigtable;
	}
	
	private function getDatabases($modelID) {
		$res = new Select('database')->where(array('model_id' => $modelID))->run();
	}

	private function getModel($ID) {
		$query = new Select('model')->where('id='.$ID)->make();
		$query->run();
	}

	private function getTableAttributes($modelID) {
		$query = new Query()->from('attribute')->where('id='.$ID);
	}
	
	private function loadUnitTables($modelID) {
		
	}
	
	private function init() {
		try {
			$dsn = $this->getDSN();
			list($u, $p) = $this->config['bigdata']['credits'];
			$this->pdo = new \PDO($dsn, $u, $p, $this->options);
		}
		catch (PDOException $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	private function getDSN() {
		$dsn = $this->config['bigdata']['vendor'];
		$dsn .= ':host' . $this->config['bigdata']['host'];
		$dsn .= ':port' . $this->config['bigdata']['port'];
		$dsn .= ';dbname' . self::DB_ . $this->config['bigdata']['dbname'];
		$dsn .= ';charset=utf8mb4';
		return $dsn;
	}
	
	
}
