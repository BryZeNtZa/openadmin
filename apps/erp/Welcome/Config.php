<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : 'Erp\Welcome' modules controllers
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Erp\Welcome;

class Config {

	/*
	 * Module controller's routes
	 */
	public static function getRoutes () {
		
		return [
			'index' => Index\Index::class,
			'connexion' => Connexion\Index::class,
			'register' => Register\Index::class,
		];
	}
}
