<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_js.php 25177 2010-02-13 17:34:48Z changi67 $

/*
 * file = external javascript file
 * data is the javascript code
 * if you need the data to be interpreted before the file use the JS plugin 2 times
 */
function wikiplugin_js_help() {
	return tra("Insert a javascript file or/and some javascript code.")."<br />~np~{JS(file=file.js)}".tra("javascript code")."{JS}~/np~";
}

function wikiplugin_js_info() {
		return array(
			'name' => tra('Javascript'),
			'documentation' => 'PluginJS',
			'description' => tra('Insert a javascript file or/and some javascript code.'),
			'prefs' => array( 'wikiplugin_js' ),
			'body' => tra('javascript code'),
			'validate' => 'all',
			'filter' => 'rawhtml_unsafe',
			'params' => array(
				'file' => array(
					'required' => false,
					'name' => tra('File'),
					'description' => tra('Javascript filename.'),
					'filter' => 'url',
				),
			),
		);
	}
function wikiplugin_js($data, $params) {
	extract($params, EXTR_SKIP);
	if(isset($file)) {
		$ret =  "~np~<script type=\"text/javascript\" src=\"$file\"></script> ~/np~";
	} else {
		$ret = '';
	}
	if ($data) {
		$ret .= "~np~<script type=\"text/javascript\">".$data."</script>~/np~"; 
	}
	return $ret;
}
