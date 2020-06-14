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

class UsersBigTable extends BigTable {
	
	public function __construct(BigData $bigData) {
		parent::__construct($bigData, 1);
	}

}
