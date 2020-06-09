<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : 'Erp\Welcome\Connection' controller actions
 * Date : Juin 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Erp\Welcome\Connection;

use OpenAdmin\Core\Request;
use OpenAdmin\Core\Controller;

class Index extends Controller {
	
	protected function getActions() {
		
		return [
			'index' => Action\Index::class,
		];
	}
}
