<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : 'OpenAdmin\Erp\Welcome\Index' module's front controller
 * Date : Juin 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Erp\Welcome\Index;

use OpenAdmin\Core\Request;
use OpenAdmin\Core\Controller;

class Index extends Controller {

	/*
	 * COntroller actions's routes
	 */
	protected function getActions() {
		
		return [
			'index' => Action\Index::class,
		];
	}
}
