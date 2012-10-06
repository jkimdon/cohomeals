<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: session.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_session_list() {
	return array (
		'session_storage' => array(
			'name' => tra('Session storage location'),
			'description' => tra('Select where the session information should be stored. Memcache sessions require memcache to be configured.'),
			'type' => 'list',
			'perspective' => false,
			'options' => array(
				'default' => tra('Default (from php.ini)'),
				'db' => tra('Database'),
				'memcache' => tra('Memcache'),
			),
		),
		'session_lifetime' => array(
			'name' => tra('Session lifetime'),
			'description' => tra('Session lifetime'),
			'hint' => tra('Value provided in minutes'),
			'type' => 'text',
			'filter' => 'digits',
			'perspective' => false,
			'size' => '4',
		),
		'session_silent' => array(
			'name' => tra('Silent session'),
			'description' => tra('Do not automatically start sessions.'),
			'perspective' => false,
			'type' => 'flag',
		),
		'session_cookie_name' => array(
			'name' => tra('Session cookie name'),
			'description' => tra('Session cookie name used instead of the PHP default configuration.'),
			'type' => 'text',
			'perspective' => false,
			'size' => 10,
		),
	);
}
