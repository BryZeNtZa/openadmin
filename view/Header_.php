<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Footer view class
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\View;

use OpenAdmin\View\Page;

class Header_ {

	private $page;
	private $template;
	
	public function __construct(Page $page) {
		$this->page = $page;
		$this->template = $this->page->engine->make('blocks::header');
	}
	
	public function load() {
		$this->template->data(['tplname' => $this->page->config['tpl.name']]);
		$this->template->data(['favicon' => $this->page->config['tpl.favicon']]);
		$this->template->data(['scripts' => $this->page->config['tpl.header.scripts']]);
		$this->template->data(['meta' => $this->page->config['tpl.header.meta']]);
		$this->template->data(['styles' => $this->page->config['tpl.header.styles']]);
		$template = $this->template;
		$this->page->engine->registerFunction('loadHeader', function() use ($template) {
			return $template->render();
		});
	}
	
}
	