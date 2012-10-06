<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: iepngfix.php 26273 2010-03-23 12:02:11Z sylvieg $

function prefs_iepngfix_list() {
	return array(
		'iepngfix_selectors' => array(
			'name' => tra('CSS selectors to be fixed'),
			'type' => 'text',
			'size' => '30',
			'hint' => tra('Separate multiple elements with a comma (,)'),
		),
		'iepngfix_elements' => array(
			'name' => tra('HTMLDomElements to be fixed'),
			'type' => 'text',
			'size' => '30',
			'hint' => tra('Separate multiple elements with a comma (,)'),
		),
	);	
}
