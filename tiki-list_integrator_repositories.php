<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-list_integrator_repositories.php 64606 2017-11-17 02:05:08Z rjsmelo $

require_once('tiki-setup.php');
require_once('lib/integrator/integrator.php');
$access->check_feature('feature_integrator');
$access->check_permission(['tiki_p_view_integrator']);
// Create instance of integrator
$integrator = new TikiIntegrator($dbTiki);
// Fill list of repositories
$repositories = $integrator->list_repositories(true);
$smarty->assign_by_ref('repositories', $repositories);
// Display the template
$smarty->assign('mid', 'tiki-list_integrator_repositories.tpl');
$smarty->display("tiki.tpl");
