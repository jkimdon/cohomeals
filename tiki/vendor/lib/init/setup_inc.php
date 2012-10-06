<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: setup_inc.php 25252 2010-02-16 12:25:14Z changi67 $

	define( 'TIKI_PATH', getcwd() );
	define( 'TIKI_DB_PATH', TIKI_PATH.'/db' );
	define( 'TIKI_LIB_PATH', TIKI_PATH.'/lib' );

	define( 'TIKI_LANG_PATH', TIKI_PATH.'/lang' );
	define( 'TIKI_MODULES_PATH', TIKI_PATH.'/modules' );
	define( 'TIKI_TEMPLATES_PATH', TIKI_PATH.'/templates' );
	define( 'TIKI_STYLES_PATH', TIKI_TEMPLATES_PATH.'/styles' );
