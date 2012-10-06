<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: categories.php 28662 2010-08-22 12:29:08Z marclaporte $

function prefs_categories_list() {
	return array(
	'categories_used_in_tpl' => array(
			'name' => tra('Categories used in templates (TPL)'),
			'description' => tra('Permits to show alternate content depending on category of current object'),
			'type' => 'flag',
			'perspective' => false,
			'help' => 'http://themes.tiki.org/Template+Tricks',
			'dependencies' => array(
				'feature_categories',
			),
		),
	);
}
