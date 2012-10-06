<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: lang.php 28063 2010-07-18 16:04:05Z jonnybradley $

function prefs_lang_list() {
	return array(
		'lang_use_db' => array(
			'name' => tra('Use database for translation'),
			'description' => tra('Use the database to store the translated strings and allow using interactive translation'),
			'type' => 'flag',
			'help' => 'Translating+Tiki+interface',
		),
	);
}
