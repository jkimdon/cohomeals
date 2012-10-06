<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-switch_perspective.php 25082 2010-02-11 17:07:03Z changi67 $

require_once 'tiki-setup.php';
require_once 'lib/perspectivelib.php';

$access->check_feature( 'feature_perspective' );

// Force preference reload, new perspective will be taken in account.
unset($_SESSION['current_perspective']);
$_SESSION['need_reload_prefs'] = true;

if( isset($_REQUEST['perspective']) ) {
	$perspective = $_REQUEST['perspective'];
	if( $perspectivelib->perspective_exists( $perspective ) ) {
		foreach( $perspectivelib->get_domain_map() as $domain => $persp ) {
			if( $persp == $perspective ) {
				$targetUrl = 'http://' . $domain;

				header( 'Location: ' . $targetUrl );
				exit;
			}
		}

		$_SESSION['current_perspective'] = $perspective;
	}
}

header( 'Location: tiki-index.php' );

// EOF
