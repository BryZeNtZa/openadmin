<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application class
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

class Application {
	
	private $router;

	public function __construct() {
		$this->router = new Router( new Request );
	}
	
	public function run() {
		$this->router->dispatch();
	}
	
}
