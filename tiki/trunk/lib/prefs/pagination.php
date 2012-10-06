<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: pagination.php 25210 2010-02-14 20:52:22Z changi67 $

function prefs_pagination_list() {
	return array(
		'pagination_firstlast' => array(
			'name' => tra("Display 'First' and 'Last' links"),
			'type' => 'flag',
		),
		'pagination_fastmove_links' => array(
			'name' => tra('Display fast move links (by 10 percent of the total number of pages) '),
			'type' => 'flag',
		),
		'pagination_hide_if_one_page' => array(
			'name' => tra('Hide pagination when there is only one page'),
			'type' => 'flag',
		),
		'pagination_icons' => array(
			'name' => tra('Use Icons'),
			'type' => 'flag',
		),
	);	
}
