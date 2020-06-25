<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Page Object
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */
 
namespace OpenAdmin\View;

use OpenAdmin\Core\Request;
use League\Plates\Engine;
use OpenAdmin\Library\Util;

class Content {
	
	private $page;
	private $template;
	private $config;
	
	public function __construct(Request $request, Page $page) {
		$this->page = $page;
		$tplRootDir = $request->getConfig()->getActiveTemplatePath();
		$this->page->engine->addFolder('elements', $tplRootDir.'/page/blocks/content-elements');
		$this->template = $this->page->engine->make('blocks::content');
		$this->config = (require $tplRootDir.'/template.php')($page);
	}

	public function load() {
		foreach($this->config as $fname=>$fn) {
			$this->page->engine->registerFunction($fname, $fn);
		}
		$this->render();
	}

	public function render() {
		echo $this->template->render();
	}

}
	