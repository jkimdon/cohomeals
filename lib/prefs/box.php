<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: box.php 64628 2017-11-19 12:03:08Z rjsmelo $

function prefs_box_list()
{
	return [
		'box_shadow_start' => [
			'name' => tra('Module (box) shadow start'),
			'description' => tra(''),
			'type' => 'textarea',
			'size' => '2',
			'default' => '',
		],
		'box_shadow_end' => [
			'name' => tra('Module (box) shadow end'),
			'description' => tra(''),
			'type' => 'textarea',
			'size' => '2',
			'default' => '',
		],
	];
}
