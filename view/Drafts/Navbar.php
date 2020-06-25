<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Nav Bar view handler
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\View;

class Navbar {
	
	private $page;
	private $userlogged;
	
	public function __construct(Page $page) {
		
		/*$this->page = $page;
		$this->userlogged = $page->request->getSession()->isLogged();
		
		if($this->userlogged) {
			$this->page->template->set_file('navbar', 'page/blocks/navbar-c.html');
		}
		else {
			$this->page->template->set_file('navbar', 'page/blocks/navbar.html');
		}*/

	}
	
	public function load() {
		//$this->page->template->set_var('page.navbar', $this->page->template->parse('navbarvar', 'navbar'));
	}
	
}
	