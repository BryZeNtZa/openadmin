<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Empty DSN Exception
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace Xdev\Workgroup\Architecture\Exception;

class EmptyDsnException extends \Exception {

	public function errorMessage() {
		return 'Empty DSN !';
	}
}
