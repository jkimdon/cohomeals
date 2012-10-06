<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-export_sheet.php 29115 2010-09-10 19:26:53Z sylvieg $

$section = 'sheet';
require_once ('tiki-setup.php');
require_once ('lib/sheet/grid.php');

$access->check_feature('feature_sheet');

$info = $sheetlib->get_sheet_info( $_REQUEST['sheetId'] );
if (empty($info)) {
	$smarty->assign('Incorrect parameter');
	$smarty->display('error.tpl');
	die;
}

$objectperms = Perms::get( 'sheet', $_REQUEST['sheetId'] );
if ($tiki_p_admin != 'y' && !$objectperms->view_sheet && !($user && $info['author'] == $user)) {
	$smarty->assign('msg', tra('Permission denied'));
	$smarty->display('error.tpl');
	die;
}

$encoding = new Encoding ();
$charsetList = $encoding->get_input_supported_encodings();
$smarty->assign_by_ref( "charsets", $charsetList );

$smarty->assign('title', $info['title']);
$smarty->assign('description', $info['description']);

$smarty->assign('page_mode', 'form' );

// Process the insertion or modification of a gallery here

$grid = new TikiSheet;

if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$smarty->assign('page_mode', 'submit' );

	$sheetId = $_REQUEST['sheetId'];
    $encoding = $_REQUEST['encoding'];

	$handler = new TikiSheetDatabaseHandler( $sheetId );
	$grid->import( $handler );

	$handler = $_REQUEST['handler'];
	
	if( !in_array( $handler, TikiSheet::getHandlerList() ) )
	{
		$smarty->assign('msg', "Handler is not allowed.");

		$smarty->display("error.tpl");
		die;
	}

	$handler = new $handler( "php://stdout" , 'UTF-8', $encoding );
	$grid->export( $handler );

	exit;
}
else
{
	$list = array();

	$handlers = TikiSheet::getHandlerList();
	
	foreach( $handlers as $key=>$handler )
	{
		$temp = new $handler;
		if( !$temp->supports( TIKISHEET_SAVE_DATA | TIKISHEET_SAVE_CALC ) )
			continue;

		$list[$key] = array(
			"name" => $temp->name(),
			"version" => $temp->version(),
			"class" => $handler
		);
	}

	$smarty->assign_by_ref( "handlers", $list );
}

$cat_type = 'sheet';
$cat_objid = $_REQUEST["sheetId"];
include_once ("categorize_list.php");

include_once ('tiki-section_options.php');
ask_ticket('sheet');
// Display the template
$smarty->assign('mid', 'tiki-export-sheets.tpl');
$smarty->display("tiki.tpl");
