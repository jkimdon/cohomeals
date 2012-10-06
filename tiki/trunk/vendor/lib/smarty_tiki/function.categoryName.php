<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.categoryName.php 25202 2010-02-14 18:16:23Z changi67 $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function smarty_function_categoryName($params, &$smarty) {
    if( ! isset( $params['id'] ) ) {
        $smarty->trigger_error("categoryName: missing 'id' parameter");
        return;
    }

	global $categlib; require_once 'lib/categories/categlib.php';
	return $categlib->get_category_name( $params['id'] );
}
