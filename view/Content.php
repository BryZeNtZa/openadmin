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
	
	public function __construct(Request $request) {
		$this->page = $page;
		$tplRootDir = $request->getConfig()->getActiveTemplatePath();
		$this->page->engine->addFolder('elements', $tplRootDir.'/page/blocks/content-elements');
		$this->template = $this->page->engine->make('blocks::content');
	}

	public function load() {
		foreach($this->page->config['blocks'] as $blockname=>$block) {
			$this->load($blockname);
		}
	}

	public function render() {
		$this->loadAllBlocks();
		echo $this->template->render();
	}

}
	