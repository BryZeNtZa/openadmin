<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application Action prototype
 * Date : Mai 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

use OpenAdmin\Library\Util;
use League\Plates\Engine as Template;

abstract class Action {

	protected $request;
	protected $actionpath;
	protected $template;
	protected $config;
	protected $language;
	protected $tplvar;

	public function __construct(Request $request) {

		$this->request = $request;
		$this->setActionPath();
		$this->template = Template::create( $request->getConfig()->getActiveTemplatePath(), $ext = 'phtml');
		//$this->template->set_file('action', 'apps/' . $this->actionpath . '.html');
		$this->language = $request->getLanguage();
	}

	abstract function perform();

	public function setActionPath() {
		$this->actionpath = $this->request->getApplication();
		$this->actionpath .= '/' . $this->request->getModule();
		$this->actionpath .= '/' . $this->request->getController();
		$this->actionpath .= '/' . $this->request->getAction();
	}

	public function render() {

		$mode = $this->request->getMode();

		switch($mode) {

			case 'ajax':
				$this->loadI18N();
				$this->perform();
				$this->template->pparse('actionvar', 'action');
			break;

			case 'include':
				$this->loadI18N();
				$this->perform();
				$this->template->pparse('actionvar', 'action');
			break;

			case 'default':
				$page = new \OpenAdmin\View\Page($this->request, $this->template);
				$page->loadContent($this->template->parse('actionvar', 'action'));
				$this->loadI18N();
				$this->perform();
				$page->render();
			break;

		}

	}
	
	private function loadI18N() {

		list($p, $m, $c, $a) = explode('/', $this->actionpath);

		$languagestr = $this->request->getConfig()->getLanguageStr($this->language);
		$languagesrc = $this->request->getConfig()->getLanguagesPath() . '/' . $languagestr;

		$this->config = Util::loadDatas($languagesrc . '/config');

		$commonlg = Util::loadDatas($languagesrc . '/common');
		$modulelg = Util::loadDatas($languagesrc . '/apps/' . $p . '/' . $m . '/module');
		$actionlg = Util::loadDatas($languagesrc . '/apps/' . $p . '/' . $m . '/actions/' . $a);

		foreach($commonlg as $code=>$word) $this->template->set_var($code, $word);
		foreach($modulelg as $code=>$word) $this->template->set_var($code, $word);
		foreach($actionlg as $code=>$word) $this->template->set_var($code, $word);
		
		// new one
		$languages = array_merge($commonlg, $modulelg, $actionlg);
		$this->template->addMethods([
			'translate' => function(Template $this->template, $languageCode) {
				return isset($languages[$languageCode]) ? $languages[$languageCode] : $languageCode
			}
		]);
	}

}
