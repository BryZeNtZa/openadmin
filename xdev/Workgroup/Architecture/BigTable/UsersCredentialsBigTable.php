<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Users Big Table
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Architecture\BigTable;

use Xdev\Workgroup\Architecture\BigData;

class UsersCredentialsBigTable extends BigTable {
	
	public function __construct(BigData $bigData) {
		parent::__construct($bigData, 2);
	}

	public function findUser($username, $password) {
		
	}
}
