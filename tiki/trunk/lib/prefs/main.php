<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: main.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_main_list() {
	return array(
		'main_shadow_start' => array(
			'name' => tra('Main shadow start'),
			'type' => 'textarea',
			'size' => '2',
		),
		'main_shadow_end' => array(
			'name' => tra('Main shadow end'),
			'type' => 'textarea',
			'size' => '2',
		),
	);	
}
