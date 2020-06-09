<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : 'Erp\Welcome\Index\Action\Index' action
 * Date : Juin 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Erp\Welcome\Index\Action;

use OpenAdmin\Core\Request;
use OpenAdmin\Core\Action;

use Xdev\Workgroup\Architecture\BigData;
use Xdev\Workgroup\Architecture\BigTable\UsersBigTable as Users;

class Index extends Action {
	
	public function __construct(Request $request) {
		parent::__construct($request);
		$this->tplvar = 'page.body';
	}
	
	public function perform() {
		$this->template->set_var('path.language', $this->request->getConfig()->getLanguageStr($this->language));

		$bigData = new BigData();
		$users = $bigData->getBigtable(Users:class)
		$users->findUser($username, $password);
	}
}
