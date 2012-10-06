<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_map.php 25177 2010-02-13 17:34:48Z changi67 $

// Displays an inline map
// Use:
// {MAP()}
//  (mapfile=>) 
//  (extents=>)

function wikiplugin_map_help() {
	return tra("Displays a map").":<br />~np~{MAP(mapfile=>,extents=>,size=>,width=>,height=>) /}~/np~";
}

function wikiplugin_map_info() {
	return array(
		'name' => tra('Map'),
		'documentation' => 'PluginMap',	
		'description' => tra('Displays a map'),
		'prefs' => array( 'feature_maps', 'wikiplugin_map' ),
		'icon' => 'pics/icons/map.png',
		'params' => array(
			'mapfile' => array(
				'required' => true,
				'name' => tra('Map File'),
				'description' => tra('?'),
			),
			'extents' => array(
				'required' => false,
				'name' => tra('Extents'),
				'description' => tra('?'),
			),
			'size' => array(
				'required' => false,
				'name' => tra('Size'),
				'description' => tra('?'),
			),
			'width' => array(
				'required' => false,
				'name' => tra('Width'),
				'description' => tra('?'),
			),
			'height' => array(
				'required' => false,
				'name' => tra('Height'),
				'description' => tra('?'),
			),
		),
	);
}

function wikiplugin_map($data, $params) {
	global $tikilib, $prefs;

	extract ($params,EXTR_SKIP);

	$mapdata="";
	if (isset($mapfile)) {
		$mapdata='mapfile='.$mapfile.'&';
	}

	$extdata="";
	if (isset($extents)) {
		$dataext=explode("|",$extents);
		if (count($dataext)==4) {
			$minx=floatval($dataext[0]);
			$maxx=floatval($dataext[1]);
			$miny=floatval($dataext[2]);
			$maxy=floatval($dataext[3]);
			$extdata="minx=".$minx."&maxx=".$maxx."&miny=".$miny."&maxy=".$maxy."&zoom=1&";
		}
	}
	
	$sizedata="";
	if (isset($size)) {
		$sizedata="size=".intval($size)."&";
	}
	$widthdata="";
	if (isset($width)) {
		$widthdata='width="'.intval($width).'"';
	}
	$heightdata="";
	if (isset($height)) {
		$heightdata='height="'.intval($height).'"';
	}	
	if(@$prefs['feature_maps'] != 'y') {
		$map=tra("Feature disabled");
	} else {
		$map='<object border="0" hspace="0" vspace="0" type="text/html" data="tiki-map.php?'.$mapdata.$extdata.$sizedata.'maponly=frame" '.$widthdata.' '.$heightdata.'><a href="tiki-map.php?'.$mapdata.$extdata.$sizedata.'"><img src="tiki-map.php?'.$mapdata.$extdata.$sizedata.'maponly=yes"/></a></object>';

	}
	return $map;
}
