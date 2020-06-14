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

class Page {
	
	public $request;
	public $engine;
	public $template;
	public $config;
	
	public function __construct(Request $request) {

		$this->request = $request;
		
		$tplRootDir = $request->getConfig()->getActiveTemplatePath();
		$this->engine = new Engine($tplRootDir, 'phtml');;

		$this->engine->addFolder('page', $tplRootDir.'/page');
		$this->engine->addFolder('blocks', $tplRootDir.'/page/blocks');

		$this->template = $this->engine->make('page::main');

		$this->config = require $tplRootDir.'/config.php';
		
		$this->loadTranslations();
	}
	
	public function setTitle($title) {
		$this->engine->addData(['title' => $title], 'blocks::header');
	}

	public function load($blocname) {
		switch ($blocname) {
			case 'header':
				(new Header_($this))->load();
			break;
			case 'navbar':
				(new Navbar($this))->load();
			break;
			case 'footer':
				(new Footer($this))->load();
			break;
			case 'tchat':
				if(!$request->getSession()->isLogged()) {
					(new VisitorChat($this))->load();
				}
			break;
		}
	}
	
	public function loadAllBlocks() {
		$this->load('header');
		$this->load('footer');
	}

	public function render() {
		$this->loadAllBlocks();
		echo $this->template->render();
	}
	
	private function loadTranslations() {

		list($p, $m, $c, $a) = explode('/', $this->getRequestPath());

		$languagestr = $this->request->getConfig()->getLanguageStr($this->request->getLanguage());
		$languagesrc = $this->request->getConfig()->getLanguagesPath() . '/' . $languagestr;

		// $this->config = Util::loadDatas($languagesrc . '/config');

		$commonlg = Util::loadDatas("{$languagesrc}/common");
		$modulelg = Util::loadDatas("{$languagesrc}/apps/{$p}/{$m}/module");
		$actionlg = Util::loadDatas("{$languagesrc}/apps/{$p}/{$m}/actions/{$a}");

		$languages = $commonlg + $modulelg + $actionlg;

		$this->engine->registerFunction('translate', function($code) use ($languages) {
			return isset($languages[$code]) ? $languages[$code] : $code;
		});
	}
	
	public function getRequestPath() {
		$path = $this->request->getApplication();
		$path .= '/' . $this->request->getModule();
		$path .= '/' . $this->request->getController();
		$path .= '/' . $this->request->getAction();
		return $path;
	}
	
}
	