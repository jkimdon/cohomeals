<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: index.php 25072 2010-02-11 15:18:57Z changi67 $

require_once ('tiki-setup.php');
if ( ! headers_sent() ) {
	header ('location: '.$prefs['tikiIndex']);
} else {
	die("header already sent");
}
