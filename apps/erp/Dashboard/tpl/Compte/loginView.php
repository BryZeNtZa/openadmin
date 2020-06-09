<?php
	
	$tpl = new OpenAdmin\Library\Template(__DIR__ . '/templates');
	$tpl->set_file('login', 'login.html');
	
	foreach($COMMON_LANGUAGE as $c=>$v) $tpl->set_var($c, $v);
	foreach($PROJECT_PARAMS  as $c=>$v) $tpl->set_var($c, $v);
	
	$tpl->set_var('languages_menu', OpenAdmin\View\ViewHelper::getLanguageMenu($APP_DEFAULTS['language']));
	$tpl->set_var('language', $APP_DEFAULTS['language']);
	
	$tpl->pparse('display', 'login');