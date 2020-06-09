<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Base controller
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

abstract class Controller {

 	protected $actions;
	
	public function __construct() {
		$this->actions = $this->getActions();
	}
	
	public function execute(Request $request) {
		(new $this->actions[$request->getAction()]($request))->render();
	}
	
	protected abstract function getActions();
	
}
