<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_tr.php 25177 2010-02-13 17:34:48Z changi67 $

function wikiplugin_tr_help() {
	$help = tra("Translate a string");
	$help .= "~np~{TR()}string{TR}~/np~";
	return $help;
}

function wikiplugin_tr_info() {
	return array(
		'name' => tra('Translate'),
		'documentation' => 'PluginTR',
		'description' => tra('Translate a string using Tikiwiki translation table.'),
		'prefs' => array( 'wikiplugin_tr' ),
		'body' => tra('string'),
		'params' => array(
		),
	);
}

function wikiplugin_tr($data) {
	return tra($data);
}
