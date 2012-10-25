<?php
// (c) Copyright 2002-2012 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: RatingSum.php 39469 2012-01-12 21:13:48Z changi67 $

require_once 'lib/rating/formula/RatingAverage.php';

class Tiki_Formula_Function_RatingSum extends Tiki_Formula_Function_RatingAverage
{
	function __construct()
	{
		$this->mode = 'sum';
	}
}

