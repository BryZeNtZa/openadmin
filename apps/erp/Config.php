<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : 'OpenAdmin\Erp' app configs
 * Date : Juin 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Erp;

class Config {
	
	/*
	 * Application module routes
	 */
	public static function getRoutes () {
		
		return [
			'welcome' => Welcome\Config::class,
			'dashboard' => Dashboard\Config::class,
		];
	}
}
