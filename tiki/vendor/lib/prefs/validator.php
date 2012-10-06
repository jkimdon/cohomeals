<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: validator.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_validator_list() {
	return array(
		'validator_emails' => array(
			'name' => tra('Validator emails (separated by comma) if different than the sender email'),
			'type' => 'text',
			'size' => 20,
		),
	);	
}
