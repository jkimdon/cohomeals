<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: socialnetworks.php 28267 2010-08-02 17:16:59Z cdrwhite $

function prefs_socialnetworks_list() {
	return array(
		'socialnetworks_twitter_consumer_key' => array(
			'name' => tra('Consumer key'),
			'description' => tra('Consumer key generated by registering your site as application at twitter'),
			'type' => 'text',
			'keywords' => 'social networks',
			'size' => 40,
		),
		'socialnetworks_twitter_consumer_secret' => array(
			'name' => tra('Consumer secret'),
			'description' => tra('Consumer secret generated by registering your site as an application at twitter'),
			'keywords' => 'social networks',
			'type' => 'text',
			'size' => 60,
		),
		'socialnetworks_facebook_api_key' => array(
			'name' => tra('API key'),
			'description' => tra('API key generated by registering your site as application at facebook'),
			'type' => 'text',
			'keywords' => 'social networks',
			'size' => 40,
		),
		'socialnetworks_facebook_application_secr' => array(
			'name' => tra('Application secret'),
			'description' => tra('Application secret generated by registering your site as an application at facebook'),
			'keywords' => 'social networks',
			'type' => 'text',
			'size' => 60,
		),
		'socialnetworks_facebook_application_id' => array(
			'name' => tra('Application ID'),
			'description' => tra('Application id generated by registering your site as an application at facebook'),
			'keywords' => 'social networks',
			'type' => 'text',
			'size' => 60,
		),
		'socialnetworks_bitly_login' => array(
			'name' => tra('bit.ly Login'),
			'description' => tra('Site wide login (username) for bit.ly'),
			'keywords' => 'social networks',
			'type' => 'text',
			'size' => 60,
		),
		'socialnetworks_bitly_key' => array(
			'name' => tra('bit.ly Key'),
			'description' => tra('Site wide API key for bit.ly'),
			'keywords' => 'social networks',
			'type' => 'text',
			'size' => 60,
		),
		'socialnetworks_bitly_sitewide' => array(
			'name' => tra('Use site-wide account'),
			'description' => tra('When setting this option to yes, only the site wide account will be used for all users'),
			'keywords' => 'social networks',
			'type' => 'flag',
		),
	);
}
