<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Temlate config
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

$assetsPath = './public';

return [
	'tpl.page.title' => 'Open Admin Default',
	'tpl.name' => 'Open Admin Default',
	'tpl.favicon' => 'favicon.ico',
	'tpl.default.theme' => 'base',
	'tpl.header.meta' => [
		['charset' => 'utf-8'],
		['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'],
		['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'],
	],
	'tpl.header.styles' => [
		'css/themes/base/jquery-ui.css',
		'vendors/bootstrap/css/bootstrap.css',
		'vendors/font-awesome/css/font-awesome.min.css',
		'css/themes/gadafic/theme.css',
		'css/main.css',
		'css/languages.css',
		'css/dropdowns-effects.css',
		'css/chat.css',
		'vendors/tooltipster/css/tooltipster.bundle.min.css',
		'css/notifs.css',
	],
	'tpl.header.scripts' => [
		'vendors/jquery/jquery.min.js',
		'vendors/jquery/ui/jquery-ui.min.js',
		'vendors/bootstrap/js/bootstrap.min.js',
		'vendors/tooltipster/js/tooltipster.bundle.min.js',
		'vendors/typed/js/typed.min.js',
		'vendors/nicescroll/jquery.nicescroll.min.js',
		'js/languages/{path.language}/common.js',
		'js/utils.js',
	],
	'tpl.footer.scripts' => [
		'js/dropdowns-effects.js',
	],
];