<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : OpenAdmin Visitors Chatbox view
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\View;

class VisitorChat {
	
	private $page;
	
	public function __construct(Page $page) {
		$this->page = $page;
		$this->page->template->set_file('visitorchat', 'page/blocks/visitorchat.html');
	}
	
	public function load() {
		$this->page->template->set_var('page.visitorchat', $this->page->template->parse('visitorchatvar', 'visitorchat'));
	}
	
}
	