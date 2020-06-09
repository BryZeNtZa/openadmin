<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Applications config
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\App;

class Config {
	
	public static function getRoutes () {
		
		return [
			'erp' => \OpenAdmin\Erp\Config::class,
			'administration' => \OpenAdmin\Administration\Config::class,
			'stocks' => \OpenAdmin\Stocks\Config::class,
			'ged' => \OpenAdmin\Ged\Config::class,
			'finances' => \OpenAdmin\Finances\Config::class,
			'hr' => \OpenAdmin\Hr\Config::class,
			'accounting' => \OpenAdmin\Accounting\Config::class,
			'taxes' => \OpenAdmin\Taxes\Config::class,
			'citizen' => \OpenAdmin\Citizen\Config::class,
			'messages' => \OpenAdmin\Messages\Config::class,
		];
	}
}
