<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-list_posts.php 28986 2010-09-06 21:45:34Z pkdille $

require_once ('tiki-setup.php');
include_once ('lib/blogs/bloglib.php');
$access->check_feature('feature_blogs');
$access->check_permission('tiki_p_blog_admin');

if (isset($_REQUEST["remove"])) {
	$access->check_authenticity();
	$bloglib->remove_post($_REQUEST["remove"]);
}

if (!isset($_REQUEST["sort_mode"])) {
	$sort_mode = 'created_desc';
} else {
	$sort_mode = $_REQUEST["sort_mode"];
}
$smarty->assign_by_ref('sort_mode', $sort_mode);

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
// Get a list of last changes to the Wiki database
$listpages = $bloglib->list_posts($offset, $maxRecords, $sort_mode, $find);
$smarty->assign_by_ref('cant', $listpages["cant"]);
$smarty->assign_by_ref('listpages', $listpages["data"]);

ask_ticket('list-posts');
// Display the template
$smarty->assign('mid', 'tiki-list_posts.tpl');
$smarty->display("tiki.tpl");
