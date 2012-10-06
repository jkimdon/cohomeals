<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_userlink.php 28331 2010-08-06 05:12:16Z pkdille $

// this script may only be included - so it's better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  die;
}

function wikiplugin_userlink_info() {
	return array(
		'name' => tra('Userlink function'),
		'documentation' => 'PluginUserlink',			
		'description' => tra('Makes a link to the user information page'),
		'prefs' => array('wikiplugin_userlink'),
		'params' => array( 
                        'user' => array(
                                'required' => false,
                                'name' => tra('User account name'),
                                'description' => 'User account name (could be email)',
                                'filter' => 'xss',
                        ),
                ),

	);
}

function wikiplugin_userlink($data, $params) {
	global $smarty;
	$path = 'lib/smarty_tiki/modifier.userlink.php';
	include_once($path);
	$func = 'smarty_modifier_userlink';
	$content = $func($params["user"], '', '', $data);
	return '~np~'.$content.'~/np~';
}
