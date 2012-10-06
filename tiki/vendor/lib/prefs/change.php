<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: change.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_change_list() {
	return array(
		'change_language' => array(
			'name' => tra('Users can change site language'),
			'description' => tra('Allow users to change the language of the menus and labels.'),
			'type' => 'flag',
		),
		'change_theme' => array(
			'name' => tra('Users can change theme'),
			'type' => 'flag',
		),
		'change_password' => array(
			'name' => tra('Users can change their password'),
			'type' => 'flag',
			'help' => 'User+Preferences',
		),
	);
}
