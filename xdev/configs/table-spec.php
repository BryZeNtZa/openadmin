<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : App DAO Configs
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

return [
	'User' => [
		'database' => ['id' => 1],
		'model' => ['id' => 1],
		'class' => XdevWorkgroup\Data\BigTable\User::class
	],
	'UserCredentials' => [
		'database' => ['id' => 1],
		'model' => ['id' => 1],
		'class' => XdevWorkgroup\Data\BigTable\UserCredentials::class
	],
];
