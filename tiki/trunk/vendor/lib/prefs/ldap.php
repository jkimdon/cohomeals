<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ldap.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_ldap_list() {
	return array(
		'ldap_create_user_tiki' => array(
			'name' => tra('Create user if not in Tiki'),
			'type' => 'flag',
		),
		'ldap_create_user_ldap' => array(
			'name' => tra('Create user if not in LDAP'),
			'type' => 'flag',
		),
		'ldap_skip_admin' => array(
			'name' => tra('Use Tiki authentication for Admin login'),
			'type' => 'flag',
		),
	);	
}
