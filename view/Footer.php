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

class Footer {

	private $page;
	private $template;
	
	public function __construct(Page $page) {
		$this->page = $page;
		$this->template = $this->page->engine->make('blocks::footer');
	}
	
	public function load() {
		$this->setLanguagesMenu();
		$this->setCopyrights();
		$template = $this->template;
		$this->page->engine->registerFunction('loadFooter', function() use ($template) {
			return $template->render();
		});
	}
	
	public function setLanguagesMenu() {

		$menu = array();

		$languages = $this->page->request->getConfig()->getLanguages();
		
		$n_lg = count($languages);
		$n_colm = 3;
		$n_lines = intval($n_lg/$n_colm);

		$printed = 0;
		for($i=1; $i<=$n_colm; $i++) {
			for($j=$printed+1; $j<=$i*$n_lines; $j++,$printed++) {
				if( !isset($languages[$j]) ) break;
				$menu[$i-1][$j] = $languages[$j];
			}
		}

		$this->template->data(['langsmenu' => $menu]);
	}
	
	public function setCopyrights() {
		$copyrights = [
			'author' => $this->page->request->getConfig()->getAuthor(),
			'date' => '2012-' . date('Y'),
		];
		$this->template->data($copyrights);
	}
	
}
	