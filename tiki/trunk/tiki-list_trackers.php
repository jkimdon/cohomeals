<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-list_trackers.php 25109 2010-02-11 23:15:37Z nkoth $

$section = 'trackers';
require_once ('tiki-setup.php');
include_once ('lib/trackers/trackerlib.php');
$auto_query_args = array('sort_mode', 'offset', 'find');
$access->check_feature('feature_trackers');
$access->check_permission(array('tiki_p_list_trackers'));
if (!isset($_REQUEST["trackerId"])) {
	$_REQUEST["trackerId"] = 0;
}
$smarty->assign('trackerId', $_REQUEST["trackerId"]);
if ($_REQUEST["trackerId"]) {
	$info = $trklib->get_tracker($_REQUEST["trackerId"]);
} else {
	$info = array();
	$info["name"] = '';
	$info["description"] = '';
	$info["descriptionIsParsed"] = '';
}
$smarty->assign('name', $info["name"]);
$smarty->assign('description', $info["description"]);
if (!isset($_REQUEST["sort_mode"])) {
	$sort_mode = 'created_desc';
} else {
	$sort_mode = $_REQUEST["sort_mode"];
}
if (!isset($_REQUEST["offset"])) {
	$offset = 0;
} else {
	$offset = $_REQUEST["offset"];
}
$smarty->assign_by_ref('offset', $offset);
if (isset($_REQUEST["find"])) {
	$find = $_REQUEST["find"];
} else {
	$find = '';
}
$smarty->assign('find', $find);
$smarty->assign_by_ref('sort_mode', $sort_mode);
$channels = $trklib->list_trackers($offset, $prefs['maxRecords'], $sort_mode, $find);
$temp_max = count($channels["data"]);
for ($i = 0; $i < $temp_max; $i++) {
	if ($userlib->object_has_one_permission($channels["data"][$i]["trackerId"], 'tracker')) {
		$channels["data"][$i]["individual"] = 'y';
		$channels["data"][$i]["individual_tiki_p_view_trackers"] = 'y';
		if ($tiki_p_admin == 'y' || $userlib->object_has_permission($user, $channels["data"][$i]["trackerId"], 'tracker', 'tiki_p_admin_trackers')) {
			$channels["data"][$i]["individual_tiki_p_view_trackers"] = 'y';
		}
	} else {
		$channels["data"][$i]["individual"] = 'n';
	}
}
$cant_pages = ceil($channels["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));
if ($channels["cant"] > ($offset + $maxRecords)) {
	$smarty->assign('next_offset', $offset + $maxRecords);
} else {
	$smarty->assign('next_offset', -1);
}
// If offset is > 0 then prev_offset
if ($offset > 0) {
	$smarty->assign('prev_offset', $offset - $maxRecords);
} else {
	$smarty->assign('prev_offset', -1);
}
include_once ('tiki-section_options.php');
$smarty->assign_by_ref('channels', $channels["data"]);
$smarty->assign('channels_cant', $channels["cant"]);
ask_ticket('list-trackers');
// Display the template
$smarty->assign('mid', 'tiki-list_trackers.tpl');
$smarty->display("tiki.tpl");
