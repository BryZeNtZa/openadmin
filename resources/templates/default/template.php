<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Temlate config
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

return function(Page $page) {

	$request = $page->request;

	return [
		'loadNav' => function () use ($page, $request) {
			$template = include './views/nav.php';
			$template = $page->engine->make('elements::nav');
			return $template->render();
		},
		'loadContent' => function () use ($page, $request) {
			$template = include './views/content-holder.php';
			$template = $page->engine->make('elements::content-holder');
			return $template->render();
		},
		'loadSidebarLeft' => function () use ($page, $request) {
			$template = include './views/sidebar-left.php';
			$template = $page->engine->make('elements::sidebar-left');
			return $template->render();
		},
		'loadSidebarRight' => function () use ($page, $request) {
			$template = include './views/sidebar-right.php';
			$template = $page->engine->make('elements::sidebar-right');
			return $template->render();
		},
		'loadVisitorChat' => function () use ($page, $request) {
			$template = include './views/visitor-chat.php';
			$template = $page->engine->make('elements::visitor-chat');
			return $template->render();
		},
	];	
}
