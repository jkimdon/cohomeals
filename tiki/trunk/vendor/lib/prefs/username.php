<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: username.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_username_list() {
	return array(
		'username_pattern' => array(
			'name' => tra('Username pattern'),
			'type' => 'text',
			'size' => 25,
			'perspective' => false,
		),
	);	
}
