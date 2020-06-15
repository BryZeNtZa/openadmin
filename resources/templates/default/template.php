<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Temlate config
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

return function(Page $page, Request $request) {
	return [
		'loadNav' => function () use ($page, $request) {
			$template = $page->engine->make('elements::footer');
		},
		'loadContent' => function () use ($page, $request) {
			
		},
	]	
}
