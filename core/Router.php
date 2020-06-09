<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application Router
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

use OpenAdmin\App\Config as AppsConfig;

class Router {
	
	private $resquest;
	
	public function __construct(Request $request) {
		$this->request = $request;
	}
	
	public function dispatch() {
		
		$appsRoutes = AppsConfig::getRoutes();
		$application = $this->request->getApplication();

		if( isset($appsRoutes[$application]) ) {
			
			$moduleRoutes = $appsRoutes[$application]::getRoutes();
			$module = $this->request->getModule();
			
			if( isset($moduleRoutes[$module]) ) {
				
				$controllerRoutes = $moduleRoutes[$module]::getRoutes();
				$controller = $this->request->getController();
				
				if( isset($controllerRoutes[$controller]) ) {
					(new $controllerRoutes[$controller])->execute($this->request);
				}
				else {
					echo 'ERREUR 404: Action not found !';
				}
			}
			else {
				echo 'ERREUR 404: Module not found !';
			}
			
		}
		else {
			echo 'ERREUR 404: Application "' . $application .'" not found !';
		}
		
	}
	
}
