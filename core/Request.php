<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application Request
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

use OpenAdmin\Library\ArrayLib;

use function count;
use function explode;

class Request {

	private $application;
	private $module;
	private $controller;
	private $action;

	private $uri;
	private $session;
	private $config;

	private $params;

    public function __construct($uri = null) {

		$this->uri = ($uri == null) ? $_SERVER['REQUEST_URI']: $uri;

		$this->session = new Session;
		$this->session->initialize();

		$this->config = new Config;
		$this->initParams();

		$this->parseAppModAction();
    }

	public function getMode() {
		$mode = $this->getParam('rqmode');
		return $mode===null ? 'default' : $mode;
	}

	public function getParam($param) {
		return isset($this->params[$param]) ? $param : null;
	}

	public function initParams() {

		foreach ($_GET as $params=>$value) {
			$this->params[$this->filterParam($params)] = $this->filterValue($value);
		}

		foreach ($_POST as $params=>$value) {
			$this->params[$this->filterParam($params)] = $this->filterValue($value);
		}
	}
	
	public function filterParam($params) {
		return $params;
	}
	
	public function filterValue($value) {
		return $value;
	}
	
	public function getApplication() {
		return $this->application;
	}
	
	public function getModule() {
		return $this->module;
	}
	
	public function getController() {
		return $this->controller;
	}
	
	public function getAction() {
		return $this->action;
	}
	
	/**
	 * Extract Module, Controller and Action from the request
	 */
	public function parseAppModAction() {
		

		$segments = explode('/', $this->uri);
		$segments = ArrayLib::clean($segments);
        $nb_segments = count($segments);
		
		$start = 2;
		
		$this->application = 
		( $nb_segments > $start ) 
		? $segments[$start] 
		: 'erp'; 
		$start++;
		
		$this->module = 
		( $nb_segments > $start ) 
		? $segments[$start] 
		: 'welcome'; 
		$start++;
		
		$this->controller = 
		( $nb_segments > $start ) 
		? $segments[$start] 
		: 'index'; 
		$start++;
		
		$this->action = 
		( $nb_segments > $start ) 
		? $segments[$start] 
		: 'index';

	}
	
	public function getSession() {
		return $this->session;
	}
	
	public function getConfig() {
		return $this->config;
	}
	
	public function getLanguage() {
		
		if( !isset($this->params['language']) ) {
			$this->params['language'] = 
			( $this->session->isLogged() ) 
			? $this->session->getLanguage() 
			: $this->config->getLanguage();
		}
		
		return $this->params['language'];
	}
	
}
