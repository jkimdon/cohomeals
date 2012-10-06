<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-custom_home.php 25079 2010-02-11 16:21:41Z changi67 $

require_once ('tiki-setup.php');

$access->check_feature('feature_custom_home');

$smarty->assign('mid', 'tiki-custom_home.tpl');
$smarty->display("tiki.tpl");
