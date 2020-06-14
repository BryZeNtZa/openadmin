<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application Action prototype
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

use League\Plates\Engine;
use OpenAdmin\View\Page;

abstract class Action {

	protected $request;
	public $page;

	public function __construct(Request $request) {
		$this->request = $request;
	}

	abstract function perform();

	public function render() {

		$mode = $this->request->getMode();

		switch($mode) {

			case 'ajax':
				$this->perform();
				$ajax = new \OpenAdmin\View\AjaxContent($this->request);
				$ajax->render();
			break;

			case 'include':
				$this->loadI18N();
				$this->perform();
				$ajax = new \OpenAdmin\View\AjaxContent($this->request);
				$ajax->render();
			break;

			case 'default':
				$this->page = new Page($this->request);
				$this->perform();
				$this->page->render();
			break;

		}

	}

}
