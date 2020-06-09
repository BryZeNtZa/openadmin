<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Footer view class
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\View;

class Footer {

	private $page;
	
	public function __construct(Page $page) {
		$this->page = $page;
		$this->page->template->set_file('footer', 'page/blocks/footer.html');
	}
	
	public function load() {
		$this->page->template->set_var('page.footer', $this->page->template->parse('footervar', 'footer'));
		$this->loadFooterLanguages();
	}
	
	public function loadFooterLanguages() {
		
		$languages = $this->page->request->getConfig()->getLanguages();
		
		$n_lg = count($languages);
		$n_colm = 3;
		$n_lines = intval($n_lg/$n_colm);

		$listHtml = '';
		$printed = 0;
		for($i=1; $i<=$n_colm; $i++) {
			$listHtml .= '<div class="col-md-4"><ul role="menu">';
			for($j=$printed+1; $j<=$i*$n_lines; $j++) {
				if( !isset($languages[$j]) ) break;
				$listHtml .= '<li><span class="lang-sm lang-lbl" lang="' . $languages[$j]['code'] . '"></span></li>';
				$printed++;
			}
			$listHtml .= '</ul></div>';
		}

		$this->page->template->set_var('var.author', $this->page->request->getConfig()->getAuthor());
		$this->page->template->set_var('var.bottomdate', '2012-' . date('Y'));
		$this->page->template->set_var('languages.list', $listHtml);
	}
}
	