<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : 'Erp\Welcome\Connection\Action\Index' action
 * Date : Juin 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Erp\Welcome\Connection\Action;

use OpenAdmin\Core\Request;
use OpenAdmin\Core\Action;

use XdevWorkgroup\BigData;
use XdevWorkgroup\BigData\BigTable\UsersBigTable;
use XdevWorkgroup\BigData\BigTable\CredentialsBigTable;

class Index extends Action {
	
	public function __construct(Request $request) {
		parent::__construct($request);
		$this->tplvar = 'page.body';
	}
	
	public function perform() {

		$bigData = new BigData();
		$bigData->refer($this->request->getContainerName());

		$usersBigTable = new UsersBigTable($bigData);
		$credentialsBigTable = new CredentialsBigTable($bigData);

		$credentialsBigTable->lookup($params);
	}
}
