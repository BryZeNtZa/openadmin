<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application Session
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

use OpenAdmin\Library\Util;
use OpenAdmin\Dao\BigData;

use function strtolower;

class Config {
	
	private $basepath;
	private $configspath;
	private $resourcespath;
	private $languagespath;
	private $templatespath;
	
	private $datas = array();
	private $languages = array();
	private $countriesTranlations = array();
	
    public function __construct() {

		$this->basepath = dirname(dirname(__FILE__));

		$this->configspath = $this->basepath . '/config';
		$this->resourcespath = $this->basepath . '/resources';
		$this->languagespath = $this->resourcespath . '/languages';
		$this->templatespath = $this->resourcespath . '/templates';

		$datas = Util::loadDatas($this->configspath . '/config');
		$this->languages = Util::loadDatas($this->configspath . '/languages');

		$this->configure($datas);
    }

	public function configure($datas) {
		foreach($datas as $key=>$data) $this->set($key, $data);
	}

	public function set($key, $data) {
		$this->datas[$key] = $data;
	}

	public function get($key) {
		return isset( $this->datas[$key] ) ? $this->datas[$key] : null;
	}

	public function getLanguage() {
		return $this->get('app.language');
	}

	public function getScriptsPath() {
		return $this->get('app.server.scripts');
	}

	public function getBasePath() {
		return $this->basepath;
	}

	public function getConfigsPath() {
		return $this->configspath;
	}

	public function getRessoucesPath() {
		return $this->resourcespath;
	}
	
	public function getLanguagesPath() {
		return $this->languagespath;
	}

	public function getTemplatesPath() {
		return $this->templatespath;
	}

	public function getActiveTemplatePath() {
		return $this->getTemplatesPath() . '/' . $this->get('app.template');
	}	

	public function getAuthor() {
		return $this->get('app.author');
	}

	public function getLanguages() {
		return $this->languages;
	}

	public function getLanguageStr($language_id) {
		return $this->languages[$language_id]['code'];
	}

	public function getContriesTranslations($language_id) {

		if($this->countriesTranlations == null ) {
			$trlfile = $this->languagespath . '/' . $this->getLanguageStr($language_id) . '/countries';
			$this->countriesTranlations = Util::loadDatas($trlfile);
		}

		return $this->countriesTranlations;
	}

}
