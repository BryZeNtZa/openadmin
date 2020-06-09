<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application Session
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

use function strtolower;

class Session {
	
	const SESSION_PREFIX = 'gfic.erp.secondary';
	
	private $datas = array();
	
    public function __construct() {

    }
	
	public function initialize() {
		
		if( !$this->isRegistered() ) {
			$this->start();
		}
	}
	
	public function configure($datas) {
		foreach($datas as $key=>$data) $this->set($key, $data);
	}
	
	public function set($key, $data) {
		$this->datas[ self::SESSION_PREFIX . '.' . strtolower($key) ] = $data;
	}
	
	public function setUserID($id) {
		$_SESSION[ self::SESSION_PREFIX . 'userid' ] = $id;
	}
	
	public function get($key) {
		$k = self::SESSION_PREFIX . '.' . strtolower($key);
		return isset( $_SESSION[$k] ) ? $this->datas[$k] : null;
	}
	
	public function start() {
		session_start();
		$_SESSION[ self::SESSION_PREFIX ] = true;
	}
	
	public function isRegistered() {
		return isset( $_SESSION[ self::SESSION_PREFIX ] );
	}
	
	public function isLogged() {
		return isset( $_SESSION[ self::SESSION_PREFIX . 'userid' ] );
	}
	
	public function getLanguage() {
		return $this->get('language');
	}
	
}
