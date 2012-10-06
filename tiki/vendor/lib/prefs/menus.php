<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: menus.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_menus_list() {
	return array(
		'menus_items_icons' => array(
			'name' => tra('Allow users to define icons for menus entries'),
			'type' => 'flag',
		),
		'menus_items_icons_path' => array(
			'name' => tra('Default path for the icons'),
			'type' => 'text',
		),
	);
}
