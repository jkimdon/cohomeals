<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.show_help.php 25202 2010-02-14 18:16:23Z changi67 $

/*
* @author: Stéohane Casset
* @date: 06/11/2008
*/

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function smarty_function_show_help($params, &$smarty)
{
	global $help_sections;

	if (count($help_sections)) {
		$smarty->assign_by_ref('help_sections',$help_sections);
		return $smarty->fetch('tiki-show_help.tpl');
	}
}
