<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: last_update.php 25174 2010-02-13 08:51:29Z changi67 $

//this script may only be included - so its better to die if called directly.
$access->check_script($_SERVER["SCRIPT_NAME"],basename(__FILE__));

/* trick for use with doc/devtools/cvsup.sh */
if ( is_file('.lastup') and is_readable('.lastup') ) {
	$lastup = file('.lastup');
	$smarty->assign('lastup', trim($lastup[0]));
}

if ( is_file('.svnrev') and is_readable('.svnrev') ) {
	$svnrev = file('.svnrev');
	$smarty->assign('svnrev', trim($svnrev[0]));
}
