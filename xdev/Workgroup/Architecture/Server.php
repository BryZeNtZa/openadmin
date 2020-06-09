<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Server Base Class
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Dao;

use OpenAdmin\Dao\CoreDB\BigDataDB;
use OpenAdmin\Dao\CoreDB\ModelDB;
use OpenAdmin\Dao\CoreDB\StaticsDB;

class Server {
	
	private $host;
	private $databases;
	
	public function __construct($host, $databases) {
		
		foreach($databases as $name=>$params) {
			$dsn = 'mysql:host=' . $host . ';dbname=' . $name;
			$this->databases[$name] = new Database($dsn, $params);
		}
		
		
		
		
		//Core Databases
		$this->bigDataDB  = new BigDataDB;
		$this->modelDB    = new ModelDB;
		$this->staticsDB  = new StaticsDB;		
	}
	
	public function setHost($host) {
		$this->host = $host;
	}

	public function getDatabases(){	
	
	}
	
	public function getNbConnexions() {
		
	}


}
