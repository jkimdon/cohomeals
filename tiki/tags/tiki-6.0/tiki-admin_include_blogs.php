<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-admin_include_blogs.php 26273 2010-03-23 12:02:11Z sylvieg $

// This script may only be included - so its better to die if called directly.
if (strpos($_SERVER['SCRIPT_NAME'], basename(__FILE__)) !== false) {
	header('location: index.php');
	exit;
}
if (isset($_REQUEST['bloglistconf'])) {
	check_ticket('admin-inc-blogs');
}
if (isset($_REQUEST['blogcomprefs'])) {
	check_ticket('admin-inc-blogs');
}
ask_ticket('admin-inc-blogs');
$smarty->assign_by_ref('blogs', $blogs['data']);
