<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_files.php 29881 2010-10-07 19:02:20Z lindonb $

/*	list files of galleries
 * galleryId
 * categId
 * 
*/
function wikiplugin_files_help() {
	return tra("List files in a file gallery (with a category) or in a category or a file gallery od this category.")
		."<br />~np~{FILES(galleryId=id,categId=id,sort=name_asc,showaction=n,showfind=n,slideshow=n)}Title{FILES}~/np~";
}
function wikiplugin_files_info() {
	return array(
		'name' => tra('Files'),
		'documentation' => 'PluginFiles',
		'description' => tra("Displays a list of files from the File Gallery"),
		'prefs' => array( 'feature_file_galleries', 'wikiplugin_files' ),
		'body' => tra('Title'),
		'icon' => 'pics/large/file-manager.png',
		'params' => array(
			'galleryId' => array(
				'required' => false,
				'name' => tra('Gallery ID'),
				'description' => tra('Gallery ID'),
			),
			'categId' => array(
				'required' => false,
				'name' => tra('Category ID'),
				'description' => tra('List of cetegory IDs separated by colon'),
				'advanced' => true,
			),
			'fileId' => array(
				'required' => false,
				'name' => tra('File ID'),
				'description' => tra('List of file IDs separated by colon'),
				'type' => 'fileId',
				'area' => 'fgal_picker_id',
				'separator' => ':',
			),
			'sort' => array(
				'required' => false,
				'name' => tra('Sort order'),
				'description' => tra('Default') . ' ' . tra('name_asc'),
			),
			'showaction' => array(
				'required' => false,
				'name' => tra('Show action'),
				'description' => 'n|y',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
			'showfind' => array(
				'required' => false,
				'name' => tra('Show find'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
				),
			'showtitle' => array(
				'required' => false,
				'name' => tra('Show title'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'y'
			),
			'showid' => array(
				'required' => false,
				'name' => tra('Show ID'),
				'description' => 'y|n',
				'default' => 'n',
				'advanced' => true,
			),
			'showicon' => array(
				'required' => false,
				'name' => tra('Show icon'),
				'description' => 'y|n',
				'filter' => 'alpha',
			),
			'showname' => array(
				'required' => false,
				'name' => tra('Show name'),
				'description' => 'y|n',
				'filter' => 'alpha',
			),
			'showfilename' => array(
				'required' => false,
				'name' => tra('Show filename'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
			'showsize' => array(
				'required' => false,
				'name' => tra('Show size'),
				'description' => 'y|n',
				'filter' => 'alpha',
			),
			'showdescription' => array(
				'required' => false,
				'name' => tra('Show description'),
				'description' => 'y|n',
				'filter' => 'alpha',
			),
			'showcreated' => array(
				'required' => false,
				'name' => tra('Show creation date'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
			'showmodified' => array(
				'required' => false,
				'name' => tra('Show last modification date'),
				'description' => 'y|n',
				'filter' => 'alpha',
			),
			'showhits' => array(
				'required' => false,
				'name' => tra('Show hits'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
			'showlockedby' => array(
				'required' => false,
				'name' => tra('Show locked by'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
			'showauthor' => array(
				'required' => false,
				'name' => tra('Show author'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
			'showcreator' => array(
				'required' => false,
				'name' => tra('Show Creator'),
				'description' => 'y|n',
				'default' => 'n',
				'advanced' => true,
			),
			'showgallery' => array(
				'required' => false,
				'name' => tra('Show parent gallery name'),
				'description' => 'y|n',
				'filter' => 'alpha',
			),
			'showfiles' => array(
				'required' => false,
				'name' => tra('Show number of files'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
			'slideshow' => array(
				'required' => false,
				'name' => tra('Show slideshow'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
			'showcomment' => array(
				'required' => false,
				'name' => tra('Show comment'),
				'description' => 'y|n',
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
			'showlasteditor' => array(
				'required' => false,
				'name' => tra('Show last editor'),
				'description' => 'y|n',
				'filter' => 'alpha',
			),
			'creator' => array(
				'required' => false,
				'name' => tra('User login'),
				'description' => tra('Show only created by this user'),
				'default' => 'n',
				'advanced' => true,
			),
			'showupload' => array(
				'required' => false,
				'name' => tra('Show upload'),
				'description' => 'y|n ' . tra('Show a simple upload form to the gallery'),
				'filter' => 'alpha',
				'default' => 'n',
				'advanced' => true,
			),
	 	)
	 );
}
function wikiplugin_files($data, $params) {
	global $prefs, $tikilib, $smarty, $tiki_p_admin, $tiki_p_admin_files_galleries, $user;
	if ($prefs['feature_file_galleries'] != 'y') {
		return('');
	}
	global $filegallib; include_once('lib/filegals/filegallib.php');
	$default = array('showfind'=>'n', 'showtitle'=>'y', 'showupload' => 'n');
	$params = array_merge($default, $params);

	$filter = '';
	extract($params, EXTR_SKIP);

	if ($prefs['feature_categories'] != 'y') {
		if (isset($categId))
			unset($categId);
	} else {
		global $categlib; include_once('lib/categories/categlib.php');
	}

	$files = array();
	if (isset($categId) && strstr($categId, ':')) {
		$categId = explode(':', $categId);
	}
	static $iplugin = 0;
	++$iplugin;
	if (isset($_REQUEST["wp_files_sort_mode$iplugin"])) {
		$sort = $_REQUEST["wp_files_sort_mode$iplugin"];
	}
	$filter = empty($creator)?'':array('creator'=>$creator);
	if (!isset($sort))
		$sort = 'name_asc';
	if (isset($galleryId)) {
		$gal_info = $tikilib->get_file_gallery($galleryId);
		if ($tiki_p_admin != 'y' && $tiki_p_admin_files_galleries != 'y' && $gal_info['user'] != $user) {
			$p_view_file_gallery = $tikilib->user_has_perm_on_object($user, $galleryId, 'file gallery', 'tiki_p_view_file_gallery');
			if ($p_view_file_gallery != 'y')
				return;
			$p_download_files = $tikilib->user_has_perm_on_object($user, $galleryId, 'file gallery', 'tiki_p_download_files');
			if ($showupload == 'y' && $tikilib->user_has_perm_on_object($user, $galleryId, 'file gallery', 'tiki_p_upload_files')) {
				$params['showupload'] = 'y';
			}
			$p_admin_file_galleries = $tikilib->user_has_perm_on_object($user, $galleryId, 'file gallery', 'tiki_p_admin_file_galleries');
			$p_edit_gallery_file = $tikilib->user_has_perm_on_object($user, $galleryId, 'file gallery', 'tiki_p_edit_gallery_file');
		} else {
			$p_download_files = 'y';
			$p_view_file_gallery = 'y';
			$p_admin_file_galleries = 'y';
			$p_edit_gallery_file = 'y';
			if ($showupload == 'y') {
				$params['showupload'] = 'y';
			}
		}
		if (!empty($slideshow) && $slideshow == 'y') {
			if ($prefs['javascript_enabled'] != 'y') return;
			if (empty($data)) $data = tra('Slideshow');
			return "~np~<a onclick=\"javascript:window.open('tiki-list_file_gallery.php?galleryId=$galleryId&find_creator=$creator&amp;slideshow','','menubar=no,width=600,height=500,resizable=yes');\" href=\"#\">".tra($data).'</a>~/np~';
		}
		$find = isset($_REQUEST['find'])?  $_REQUEST['find']: '';
		$fs = $tikilib->get_files(0, -1, $sort, $find, $galleryId, false, true, true, true, false, false, true, false, '', true, false, false, $filter);
		if (isset($categId)) {
			$objects = $categlib->list_category_objects($categId, 0, -1, 'itemId_asc', 'file');
			$objects_in_categs = array();
			foreach($objects['data'] as $o) {
				$objects_in_categs[] = $o['itemId'];
			}
		}
		for ($i = 0; $i < $fs['cant']; ++$i) {
			if (isset($categId)) { // filter the files
				if (!in_array($fs['data'][$i]['fileId'], $objects_in_categs)) {
					continue;
				}
			}
			$fs['data'][$i]['p_download_files'] = $p_download_files;
			$fs['data'][$i]['p_view_file_gallery'] = $p_view_file_gallery;
			$fs['data'][$i]['p_admin_file_galleries'] = $p_admin_file_galleries;
			$fs['data'][$i]['p_edit_gallery_file'] = $p_edit_gallery_file;
			$fs['data'][$i]['galleryType'] = $gal_info['type'];
			$fs['data'][$i]['lockable'] = $gal_info['lockable'];
			$files[] = $fs['data'][$i];
		}
	} elseif (isset($categId)) {
		// galls of this category
		$objects = $categlib->list_category_objects($categId, 0, -1, 'itemId_asc', 'file gallery');
		// get the files of the gallery
		foreach ($objects['data'] as $og) {
			$gal_info = $tikilib->get_file_gallery($og['itemId']);
			if ($tiki_p_admin != 'y' && $tiki_p_admin_files_galleries != 'y' && $gal_info['user'] != $user) {
				$p_view_file_gallery = $tikilib->user_has_perm_on_object($user, $gal_info['galleryId'], 'file gallery', 'tiki_p_view_file_gallery');
				if ($p_view_file_gallery != 'y')
					continue;
				$p_download_files = $tikilib->user_has_perm_on_object($user, $gal_info['galleryId'], 'file gallery', 'tiki_p_download_files');
				$p_admin_file_galleries = $tikilib->user_has_perm_on_object($user, $gal_info['galleryId'], 'file gallery', 'tiki_p_admin_file_galleries');
				$p_edit_gallery_file = $tikilib->user_has_perm_on_object($user, $gal_info['galleryId'], 'file gallery', 'tiki_p_edit_gallery_file');
			} else {
				$p_download_files = 'y';
				$p_view_file_gallery = 'y';
				$p_admin_file_galleries = 'y';
				$p_edit_gallery_file = 'y';
			}

			$fs = $tikilib->get_files(0, -1, $sort, '', $og['itemId'], false, true, false, true, false, true, true, false, '', true, false, false, $filter);			                                                      
			if ($fs['cant']) {
				for ($i = 0; $i < $fs['cant']; ++$i) {
					$fs['data'][$i]['gallery'] = $gal_info['name'];
					$fs['data'][$i]['galleryId'] = $gal_info['galleryId'];
					$fs['data'][$i]['p_download_files'] = $p_download_files;
					$fs['data'][$i]['p_view_file_gallery'] = $p_view_file_gallery;
					$fs['data'][$i]['p_admin_file_galleries'] = $p_admin_file_galleries;
					$fs['data'][$i]['galleryType'] = $gal_info['type'];
					$fs['data'][$i]['lockable'] = $gal_info['lockable'];
					$fs['data'][$i]['p_edit_gallery_file'] = $p_edit_gallery_file;
				}
				$files = array_merge($files, $fs['data']);
			}
		}
		// files from this categ
		$objects = $categlib->list_category_objects($categId, 0, -1, 'itemId_asc', 'file');
		foreach ($objects['data'] as $of) {
			if ($info = wikiplugin_files_check_perm_file($of['itemId'])) {
				$files[] = $info;
			}
		}
		$gal_info = $filegallib->default_file_gallery();
	} elseif (isset($fileId)) {
		foreach ($fileId as $id) {
			if ($info = wikiplugin_files_check_perm_file($id)) {
				$files[] = $info;
			}
		}
		$gal_info = $filegallib->default_file_gallery();
	}
	$smarty->assign_by_ref('files', $files);
	if (isset($data))
		$smarty->assign_by_ref('data', $data);
	else
		$smarty->assign('data', '');
	include_once('fgal_listing_conf.php');
	$gal_info['show_checked' ] = 'n'; // the multiple action will not work
	if (!empty($showid)) $gal_info['show_id'] = $showid;
	if (!empty($showicon)) $gal_info['show_icon'] = $showicon;
	if (!empty($showsize)) $gal_info['show_size'] = $showsize;
	if (!empty($showdescription)) $gal_info['show_description'] = $showdescription;
	if (!empty($showcreated)) $gal_info['show_created'] = $showcreated;
	if (!empty($showcreator)) $gal_info['show_creator'] = $showcreator;
	if (!empty($showauthor)) $gal_info['show_author'] = $showauthor;
	if (!empty($showmodified)) {$gal_info['show_lastmodif'] = $gal_info['show_modified'] = $showmodified;}
	if (!empty($showlockedby)) $gal_info['show_lockedby'] = $showlockedby;
	if (!empty($showhits)) $gal_info['show_hits'] = $showhits;
	if (!empty($showfiles)) $gal_info['show_files'] = $showfiles;
	if (!empty($showaction)) $gal_info['show_action'] = $showaction;
	if (!empty($showcomment)) $gal_info['show_comment'] = $showcomment;
	if (!empty($showlasteditor)) $gal_info['show_last_user'] = $showlasteditor;
	if (!empty($showname) && $showname == 'y' && !empty($showfilename) && $showfilename == 'y') $gal_info['show_name'] = 'a';
	if (!empty($showname) && $showname == 'y' && !empty($showfilename) && $showfilename == 'n') $gal_info['show_name'] = 'n';
	if (!empty($showname) && $showname == 'n' && !empty($showfilename) && $showfilename == 'y') $gal_info['show_name'] = 'f';

	$smarty->assign_by_ref('gal_info', $gal_info);

	if (empty($showgallery)) {
		$show_parentName = empty($galleryId)? 'y': 'n';
	} else {
		$show_parentName = $showgallery;
	}
	$smarty->assign('show_parentName', $show_parentName);

	if (isset($categId)) {
		if (is_array($categId)) {
			foreach ($categId as $cat) {
				$category[] = $categlib->get_category_name($cat);
			}
		} else {
			$category = $categlib->get_category_name($categId);
		}
		$smarty->assign_by_ref('category', $category);
	} else
		$smarty->assign('category', '');
	$smarty->assign_by_ref('params', $params);
	$smarty->assign('sort_arg', "wp_files_sort_mode$iplugin");
	return '~np~'.$smarty->fetch('wiki-plugins/wikiplugin_files.tpl').'~/np~';
}
	function  wikiplugin_files_check_perm_file($fileId) {
		global $filegallib, $tikilib, $tiki_p_admin, $user, $tiki_p_admin_files_galleries;
		$info = $filegallib->get_file_info($fileId);
		$gal_info = $tikilib->get_file_gallery($info['galleryId']);
		if ($tiki_p_admin != 'y' && $tiki_p_admin_files_galleries != 'y' && $gal_info['user'] != $user) {
			$info['p_view_file_gallery'] = $tikilib->user_has_perm_on_object($user, $info['galleryId'], 'file gallery', 'tiki_p_view_file_gallery');
			if ($info['p_view_file_gallery'] != 'y') {
				return false;
			}
			$info['p_download_files'] = $tikilib->user_has_perm_on_object($user, $info['galleryId'], 'file gallery', 'tiki_p_download_files');
			$info['p_admin_file_galleries'] = $tikilib->user_has_perm_on_object($user, $info['galleryId'], 'file gallery', 'tiki_p_admin_file_galleries');
			$info['p_edit_gallery_file'] = $tikilib->user_has_perm_on_object($user, $info['galleryId'], 'file gallery', 'tiki_p_edit_gallery_file');
		} else {
			$info['p_download_files'] = 'y';
			$info['p_view_file_gallery'] = 'y';
			$info['p_admin_file_galleries'] = 'y';
			$info['p_edit_gallery_file'] = 'y';
		}
		$info['gallery'] = $gal_info['name'];
		$info['galleryType'] = $gal_info['type'];
		$info['lockable'] = $gal_info['lockable'];
		$info['id'] = $info['fileId'];
		$info['parentName'] = $gal_info['name'];
		$info['size'] = $info['filesize'];
		return $info;
	}