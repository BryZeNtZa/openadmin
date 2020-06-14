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

/*use Xdev\Workgroup\Architecture\BigData;
use Xdev\Workgroup\Architecture\BigTable\UsersBigTable as Users;
use Xdev\Workgroup\Architecture\BigTable\UsersCredentialsBigTable as UsersCredentials;*/

class Index extends Action {
	
	public function __construct(Request $request) {
		parent::__construct($request);
	}
	
	public function perform() {
		
		$this->page->setTitle('Bonjour à tous !');
		/*$bigData = new BigData();

		$usersCredentials = $bigData->getBigtable(UsersCredentials:class);
		$usersCredentialsResults = $usersCredentials->findUser($username, $password);
		
		if(!empty($usersDatas)) {
			$users = $bigData->getBigtable(Users:class);
			$userData = $usersCredentialsResults->first();
		}*/
	}
}
