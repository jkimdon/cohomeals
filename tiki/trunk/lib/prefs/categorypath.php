<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: categorypath.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_categorypath_list() {
	return array(

	'categorypath_excluded' => array(
			'name' => tra('Exclude these categories'),
			'hint' => tra('Separate category IDs with a comma (,)'),
			'type' => 'text',
			'size' => '15',
			),
		);
}
