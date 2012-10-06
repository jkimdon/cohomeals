<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-assistant.php 26808 2010-04-28 12:30:41Z jonnybradley $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

// This is the start of a guideance wizard
// Damian aka damosoft aka TikiGod

function module_assistant_info() {
	return array(
		'name' => tra('TikiWiki assistant'),
		'description' => tra('Displays an assistant to guide new Tiki admins.'),
		'prefs' => array(),
		'params' => array()
	);
}


