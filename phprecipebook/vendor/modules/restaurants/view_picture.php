<?php
	$restaurant_id = isset( $_GET['restaurant_id'] ) ? $_GET['restaurant_id'] : 0;
	require_once("../../includes/config_inc.php");
	require_once("../../custom_inc.php");
	include_once('../../libs/adodb/adodb.inc.php');

	$DB_LINK = ADONewConnection($g_rb_database_type);
	$DB_LINK->debug = FALSE; //debugging will ruin the headers for the image
	$DB_LINK->PConnect($g_rb_database_host, $g_rb_database_user, $g_rb_database_password, $g_rb_database_name);
	
	$sql = "SELECT restaurant_picture,restaurant_picture_type FROM $db_table_restaurants WHERE restaurant_id=" . $restaurant_id;
	$rc = $DB_LINK->Execute($sql);
	Header("Content-type: " . $rc->fields['restaurant_picture_type']);
	if ($g_rb_database_type=="postgres") {
		echo $DB_LINK->BlobDecode($rc->fields['restaurant_picture']);
	} else {
		echo $rc->fields['restaurant_picture'];
	}
?>