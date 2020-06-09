<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : App DAO Configs
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */
namespace XdevWorkgroup\Architecture\Table;

use XdevWorkgroup\Data\BigTable\User;

class User extends Table {
	
	public function __construct() {
		parent::__construct(1, 1, User::class);
	}
}
