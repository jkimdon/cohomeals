<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-top_file_galleries.php 26808 2010-04-28 12:30:41Z jonnybradley $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function module_top_file_galleries_info() {
	return array(
		'name' => tra('Top File Galleries'),
		'description' => tra('Displays the specified number of file galleries with links to them, starting with the one with most hits.'),
		'prefs' => array( 'feature_file_galleries' ),
		'params' => array(),
		'common_params' => array('nonums', 'rows')
	);
}

function module_top_file_galleries( $mod_reference, $module_params ) {
	global $tikilib, $smarty, $prefs;
	$ranking = $tikilib->get_files(0, $mod_reference["rows"], 'hits_desc', null, $prefs['fgal_root_id'], false, true, false, false, false, false, false);
	
	$smarty->assign('modTopFileGalleries', $ranking["data"]);
}
