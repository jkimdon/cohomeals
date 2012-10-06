<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: box.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_box_list() {
	return array(
		'box_shadow_start' => array(
			'name' => tra('Module (box) shadow start'),
			'type' => 'textarea',
			'size' => '2',
		),
		'box_shadow_end' => array(
			'name' => tra('Module (box) shadow end'),
			'type' => 'textarea',
			'size' => '2',
		),
	);	
}
