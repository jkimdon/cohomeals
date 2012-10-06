<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Container.php 25256 2010-02-16 13:02:18Z changi67 $

interface Perms_Reflection_Container
{
	function add( $group, $permission );
	function remove( $group, $permission );

	function getDirectPermissions();
	function getParentPermissions();
}
