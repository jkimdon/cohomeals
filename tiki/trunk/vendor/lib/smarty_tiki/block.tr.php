<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: block.tr.php 25202 2010-02-14 18:16:23Z changi67 $

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     block.translate.php
 * Type:     block
 * Name:     translate
 * Purpose:  translate a block of text
 * -------------------------------------------------------------
 */
 
//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER['SCRIPT_NAME'],basename(__FILE__)) !== false) {
  header('location: index.php');
  exit;
}

function smarty_block_tr($params, $content, &$smarty) {

	if ($content == '')
		return;
	if (empty($params['lang'])) {
		$lang = '';
	} else {
		$lang = $params['lang'];
	}

	$args = array();
	foreach( $params as $key => $value ) {
		if( is_int( $key ) )
			$args[$key] = $value;
	}

	if (empty($params['interactive']) || $params['interactive'] == 'y')
		return tra($content,$lang, false, $args);
	else
		return tra($content,$lang, true);
}
