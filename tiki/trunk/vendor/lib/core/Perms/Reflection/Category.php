<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Category.php 28738 2010-08-27 17:18:06Z sampaioprimo $

require_once 'lib/core/Perms/Reflection/Object.php';

class Perms_Reflection_Category extends Perms_Reflection_Object
{
	function getParentPermissions() {
		return $this->factory->get( 'global', null )->getDirectPermissions();
	}
}
