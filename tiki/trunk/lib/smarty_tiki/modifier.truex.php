<?php
// (c) Copyright 2002-2012 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.truex.php 39469 2012-01-12 21:13:48Z changi67 $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     modifier
 * Replaces 1 (=TRUE) with a 'x'. Anything else with '-'
 * used for example to output file permissions in
 * tiki-admin_security
 * -------------------------------------------------------------
 */
function smarty_modifier_truex($string)
{
  if ((int)$string == 1) return('x');
  return('-');
}
