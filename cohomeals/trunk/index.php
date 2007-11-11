<?php
include_once 'includes/init.php';

// If not yet logged in, you will be redirected to login.php before
// we get to this point (by connect.php included above)

// fake cron job for auto-renewal of heart subscriptions
update_subscriptions();

do_redirect ( "month.php" );
?>
