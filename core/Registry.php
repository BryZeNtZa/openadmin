<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application Registry
 * Date : June 2020
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

class Registry {

	private static $_instance = null;
	private static $_services = array();

	private function __construct() {

	}
	
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

	public static function get($key, $default = null) {
		if (isset(self::$_services[$key])) {
			return self::$_services[$key];
		}

		return $default;
	}

	public static function set($key, $service = null) {
		self::$_services[$key] = $service;
	}

	public static function erase($key) {
		unset(self::$_services[$key]);
	}

}
