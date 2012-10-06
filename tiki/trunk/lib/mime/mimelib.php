<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mimelib.php 25252 2010-02-16 12:25:14Z changi67 $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

include_once('lib/mime/mimetypes.php');

// returns mimetypes of files
function tiki_get_mime($filename, $fallback = '') {
	global $mimetypes;
	
	if (function_exists("mime_content_type")) {
		//notice: this is the better way. 
		//Compile php with --enable-mime-magic
		//to be able to use this.
		return mime_content_type($filename);
		
	}
	
	if (isset($mimetypes)) {
		
		$ext = pathinfo($filename);
		$ext = isset($ext['extension']) ? $ext['extension'] : '';
		$mimetype = isset($mimetypes[$ext]) ? $mimetypes[$ext] : '';
		
		if (!empty($mimetype)) {
			return $mimetype;
		}
	}
	
	if ( $fallback != '' ) {
		return $fallback;
	} else {
		//The "Microsoft Way" - just kidding
		$defaultmime = "application/octet-stream";

		include_once ("lib/mime/mimetypes.php");
		$filesplit = preg_split("/\.+/", $filename, -1, PREG_SPLIT_NO_EMPTY);
		$ext = $filesplit[count($filesplit) - 1];

		if (isset($mimetypes[$ext])) {
			return $mimetypes[$ext];
		} else {
			return $defaultmime;
		}
	}
}

//returns "image" from image/jpeg
function tiki_get_mime_main($filename) {
	$filesplit = preg_split("#/+#", tiki_get_mime($filename));

	return $filesplit["0"];
}

//returns "jpeg" from image/jpeg
function tiki_get_mime_sub($filename) {
	$filesplit = preg_split("#/+#", tiki_get_mime($filename));

	return $filesplit["1"];
}
