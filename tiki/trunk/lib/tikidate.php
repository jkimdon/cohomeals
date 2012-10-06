<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tikidate.php 25175 2010-02-13 09:11:55Z changi67 $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

if (version_compare(PHP_VERSION, '5.1.0', '>=') && function_exists("date_create"))  {
	require_once('tikidate-php5.php');
} else {
	require_once('tikidate-pear-date.php');
}

