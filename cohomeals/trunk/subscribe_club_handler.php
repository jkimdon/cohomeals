<?php
include_once 'includes/init.php';

$error = '';

$club_id = getGetValue( 'club_id' );
$action = getGetValue( 'action' );

edit_club_subscription( $club_id, $login, $action );
// add_financial_event is called in edit_club_subscription


// return to club subscription page
$url = "subscribe_club.php";
do_redirect ( $url );


?>
