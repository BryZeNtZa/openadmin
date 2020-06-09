<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : App DAO Configs
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Dao;
 
class Config {
	
	private $servers = array();
	private $databases  = array();
	
	public function __construct() {
		
		$configspath = dirname(dirname(__FILE__)) . '/config';
		
		$this->servers =  require $configspath . '/servers.php';
		$this->databases =  require $configspath . '/core-databses.php';
	}
	
	public function getDBParams($dbname) {
		return $this->databases[$dbname];
	}
	
	public function getLessLoadedServerParams($serversIDArray) {
		return $this->databases[$serversIDArray[0]];
	}
		

}
