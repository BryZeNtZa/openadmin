<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : U
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */
namespace XdevWorkgroup\Architecture\Table;

use XdevWorkgroup\Data\BigTable\UserCredentials;

class UserCredentials extends Table {
	
	public function __construct() {
		$this->setBigTableClass(UserCredentials::class);
		$this->setDatabaseID(2);
		$this->setModelID(2);
	}
}
