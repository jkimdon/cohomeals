<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: StaticKeyFilterRule.php 28738 2010-08-27 17:18:06Z sampaioprimo $

require_once 'lib/core/DeclFilter/FilterRule.php';
require_once 'lib/core/TikiFilter.php';

class DeclFilter_StaticKeyFilterRule extends DeclFilter_FilterRule
{
	private $rules;

	function __construct( $rules )
	{
		$this->rules = $rules;
	}

	function match( $key )
	{
		return array_key_exists( $key, $this->rules );
	}

	function getFilter( $key )
	{
		return TikiFilter::get( $this->rules[$key] );
	}
}
