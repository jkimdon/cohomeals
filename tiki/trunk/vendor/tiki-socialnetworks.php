<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-socialnetworks.php 28267 2010-08-02 17:16:59Z cdrwhite $

$section = 'mytiki';
require_once ('tiki-setup.php');
require_once ('lib/socialnetworkslib.php');


// Feature available?
if ($prefs['feature_socialnetworks'] !='y') {
	$smarty->assign('msg', tra("This feature is disabled") . ": feature_socialnetworks");
	$smarty->display("error.tpl");
	die;
}
$access->check_user($user);
$access->check_permission('tiki_p_socialnetworks',tra('Social networks'));

if (isset($_REQUEST['request_twitter'])) {
	if (!isset($_REQUEST['oauth_verifier'])) {
		// user asked to give us access to twitter
		$socialnetworkslib->getTwitterRequestToken();
	} else {
		if (isset($_SESSION['TWITTER_REQUEST_TOKEN'])) {
			// this is the callback from twitter
			check_ticket('socialnetworks');
			$socialnetworkslib->getTwitterAccessToken($user);
		} // otherwise it is just a reload of this page
	}
}
if (isset($_REQUEST['remove_twitter'])) {
	// remove user token from tiki
	$tikilib->set_user_preference($user, 'twitter_token','');
	$smarty->assign('show_removal',true);
}
$token=$tikilib->get_user_preference($user, 'twitter_token', '');
$smarty->assign('twitter', ($token!=''));

if (isset($_REQUEST['request_facebook'])) {
	if (!isset($_REQUEST['code'])) {
		// user asked to give us access to twitter
		$socialnetworkslib->getFacebookRequestToken();
	} else {
		if ($tikilib->get_user_preference($user, 'facebook_token', '')=='') {
			// this is the callback from facebook
			check_ticket('socialnetworks');
			$socialnetworkslib->getFacebookAccessToken($user);
		} // otherwise it is just a reload of this page
	}
}
if (isset($_REQUEST['remove_facebook'])) {
	// remove user token from tiki
	$tikilib->set_user_preference($user, 'facebook_token','');
	$smarty->assign('show_removal',true);
}

if (isset($_REQUEST['accounts'])) {
	$tikilib->set_user_preference($user, 'bitly_login', $_REQUEST['bitly_login']);
	$smarty->assign('bitly_login',$_REQUEST['bitly_login']);		
	$tikilib->set_user_preference($user, 'bitly_key', $_REQUEST['bitly_key']);
	$smarty->assign('bitly_key',$_REQUEST['bitly_key']);		
} else {
	$smarty->assign('bitly_login',$tikilib->get_user_preference($user, 'bitly_login',''));
	$smarty->assign('bitly_key',$tikilib->get_user_preference($user, 'bitly_key',''));
}
$token=$tikilib->get_user_preference($user, 'facebook_token', '');
$smarty->assign('facebook', ($token!=''));
$smarty->assign('twitterRegistered',$socialnetworkslib->twitterRegistered());
$smarty->assign('facebookRegistered',$socialnetworkslib->facebookRegistered());

ask_ticket('socialnetworks');
$smarty->assign('mid', 'tiki-socialnetworks.tpl');
$smarty->display("tiki.tpl");
