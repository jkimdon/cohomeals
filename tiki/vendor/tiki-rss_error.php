<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-rss_error.php 25081 2010-02-11 17:00:23Z changi67 $

$access->check_script($_SERVER["SCRIPT_NAME"], basename(__FILE__));
$feed = tra("Error Message");
$title = tra("Tiki RSS Feed Error Message: $errmsg");
$desc = $errmsg;
$id = "errorMessage";
$titleId = "title";
$descId = "description";
$dateId = "lastModif";
$authorId = "";
$readrepl = "";
$uniqueid = $feed;
$changes = array("data" => array());
$output = $rsslib->generate_feed($feed, $uniqueid, '', $changes, $readrepl, '', $id, $title, $titleId, $desc, $descId, $dateId, $authorId);
header("Content-type: " . $output["content-type"]);
print $output["data"];
die;
