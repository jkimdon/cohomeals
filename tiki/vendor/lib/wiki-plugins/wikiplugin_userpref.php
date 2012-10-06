<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_userpref.php 25177 2010-02-13 17:34:48Z changi67 $

function wikiplugin_userpref_info() {
	return array(
		'name' => tra('Userpref'),
		'documentation' => 'PluginUserpref',
		'description' => tra("Display wiki text if user has a pref set to a value"),
		'body' => tra('Wiki text to display if conditions are met. The body may contain {ELSE}. Text after the marker will be displayed to users not matching the condition.'),
		'prefs' => array('wikiplugin_userpref'),
		'filter' => 'wikicontent',
		'extraparams' => true,
		'params' => array(
		),
	);
}

function wikiplugin_userpref($data, $params) {
	global $user, $prefs, $tikilib;
	$dataelse = '';
	if (strpos($data,'{ELSE}')) {
		$dataelse = substr($data,strpos($data,'{ELSE}')+6);
		$data = substr($data,0,strpos($data,'{ELSE}'));
	}

	$else = false;
	foreach ($params as $prefName=>$prefValue) {
		if ($tikilib->get_user_preference($user, $prefName) != $prefValue) {
			return $dataelse;
		}
	}
	return $data;
}
