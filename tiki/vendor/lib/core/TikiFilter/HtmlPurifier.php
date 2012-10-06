<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: HtmlPurifier.php 25720 2010-02-25 19:45:26Z changi67 $

class TikiFilter_HtmlPurifier implements Zend_Filter_Interface
{
	private $cache;

	function __construct( $cacheFolder ) {
		$this->cache = $cacheFolder;
	}

	function filter( $data ) {
		require_once 'lib/htmlpurifier/HTMLPurifier.includes.php';

		$config = HTMLPurifier_Config::createDefault();
		$config->set( 'Cache', 'SerializerPath', $this->cache );
		$purifier = new HTMLPurifier($config);

		return $purifier->purify( $data );
	}
}
