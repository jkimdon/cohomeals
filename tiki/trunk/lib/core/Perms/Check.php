<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Check.php 25256 2010-02-16 13:02:18Z changi67 $

interface Perms_Check
{
	function check( Perms_Resolver $resolver, array $context, $name, array $groups );
}
