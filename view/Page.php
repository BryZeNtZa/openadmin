<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Page Object
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */
 
namespace OpenAdmin\View;

use OpenAdmin\Core\Template;
use OpenAdmin\Core\Request;

class Page {
	
	public $request;
	public $template;
	
	public function __construct(Request $request, Template $template) {
		
		$this->request   = $request;
		$this->template  = $template;
		
		$this->template->set_file('page', 'page/main.html');
		
		$this->loadScripts();
		$this->loadNavbar();
		if(!$request->getSession()->isLogged()) {
			$this->loadVisitorChat();
		}
		$this->loadFooter();
	}
	
	public function loadScripts() {
		
		$scriptsPath = $this->request->getConfig()->getScriptsPath();
		
		$this->template->set_var('path.css', $scriptsPath . '/css');
		$this->template->set_var('path.js', $scriptsPath . '/js');
		$this->template->set_var('path.vendors', $scriptsPath . '/vendors');
		$this->template->set_var('path.img', $scriptsPath . '/img');
		$this->template->set_var('path.favicon', $scriptsPath . '/favicon.ico');
	}
	
	public function loadNavbar() {
		(new Navbar($this))->load();
	}
	
	public function loadContent($html) {
		$this->template->set_var('page.container', $html);
	}
	
	public function loadFooter() {
		(new Footer($this))->load();
	}
	
	public function loadVisitorChat() {
		(new VisitorChat($this))->load();
	}
	
	public function render() {
		$this->template->pparse('pagevar', 'page');
	}
	
}
	