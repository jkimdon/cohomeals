<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: javascript.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_javascript_list() {
	return array(
		'javascript_cdn' => array(
			'name' => tra('Use CDN for Javascript'),
			'description' => tra('Obtain jQuery and jQuery UI libraries through a content delivery network.'),
			'type' => 'list',
			'options' => array(
				'none' => tra('None'),
				'google' => tra('Google'),
			),
		),
	);
}

