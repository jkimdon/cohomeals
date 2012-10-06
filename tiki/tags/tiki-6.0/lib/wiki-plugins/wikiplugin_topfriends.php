<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_topfriends.php 25177 2010-02-13 17:34:48Z changi67 $

function wikiplugin_topfriends_help() {
	return tra("List top-scoring users").":<br />~np~{TOPFRIENDS(limit=>5,public=>y)}{TOPFRIENDS}~/np~";
}

function wikiplugin_topfriends_info() {
	return array(
		'name' => tra('Top Friends'),
		'documentation' => 'PluginTopFriends',
		'description' => tra('List top-scoring users.'),
		'prefs' => array( 'feature_friends', 'wikiplugin_topfriends' ),
		'params' => array(
			'limit' => array(
				'required' => false,
				'name' => tra('Limit'),
				'description' => tra('Maximum result count.'),
			),
			'public' => array(
				'required' => false,
				'name' => tra('Public'),
				'description' => 'y|n',
			),
		),
	);
}

function wikiplugin_topfriends($data, $params) {
	global $smarty, $prefs, $tiki_p_list_users, $tikilib;
	
	/* Check we can be called */
	if($prefs['feature_friends'] != 'y') {
		return ' ';  
	}
	extract ($params, EXTR_SKIP);

	if(!(isset($limit) && $limit <> '')) {
		$limit = 5;
	}

	if((isset($public) && $public != 'y') && ($tiki_p_list_users != 'y')) {
		// Access denied
		return ' ';
	}

	$listusers = $tikilib->list_users(0 , $limit, 'score_desc', '', false);
	$smarty->assign_by_ref('listusers', $listusers["data"]);

	return $smarty->fetch('plugins/plugin-topfriends.tpl');
}
