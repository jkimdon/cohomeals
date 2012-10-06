<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_groupstat.php 27076 2010-05-11 14:16:55Z sept_7 $

function wikiplugin_groupstat_info() {
	return array(
		'name' => tra('Group Stats'),
		'documentation' => 'PluginGroupStat',
		'description' => tra("Displays some stat about group belonging"),
		'body' => tra('Title'),
		'params' => array(
			'groups' => array(
				'required' => false,
				'name' => tra('groups'),
				'description' => tra('Groups separated by :'),
			),
			'show_percent' => array(
				'required' => false,
				'name' => tra('Show Percentage'),
				'description' => 'y|n',
			),
			'show_bar' => array(
				'required' => false,
				'name' => tra('Show Bar'),
				'description' => 'y|n',
			),
		),
	);
}

function wikiplugin_groupstat($data, $params) {
	global $smarty, $prefs, $userlib, $tikilib;

	if (isset($params['groups'])) {
		$groups = explode(':', $params['groups']);
		$query = 'SELECT COUNT(DISTINCT(*)) FROM `users_usergroups` WHERE `groupName` IN('.implode(',', array_fill(0,count($groups),'?')).')';
		$total = $tikilib->getOne($query, $groups);
	} else {
		$groups = $userlib->list_all_groups();
		$total = $userlib->nb_users_in_group();
	}
	$stats = array();
	foreach ($groups as $group) {
		$nb = $userlib->nb_users_in_group($group);
		$stats[] = array('group' => $group, 'nb' => $nb);
	}
	foreach ($stats as $i=>$stat) {
		$stats[$i]['percent'] = ($stat['nb'] * 100) / $total;
	}
	$smarty->assign_by_ref('params', $params);
	$smarty->assign_by_ref('stats', $stats);
	return "~np~".$smarty->fetch('wiki-plugins/wikiplugin_groupstat.tpl')."~/np~";
}
