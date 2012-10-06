<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: pam.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_pam_list() {
	return array(
		'pam_create_user_tiki' => array(
			'name' => tra('Create user if not in Tiki'),
			'type' => 'flag',
		),
		'pam_skip_admin' => array(
			'name' => tra('Use Tiki authentication for Admin login'),
			'type' => 'flag',
		),
		'pam_service' => array(
			'name' => tra('PAM service'),
			'type' => 'text',
			'size' => 20,
			'hint' => tra('Currently unused'),
		),
	);	
}
