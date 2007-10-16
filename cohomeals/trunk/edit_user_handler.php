<?php
/* $Id */

// There is the potential for a lot of mischief from users trying to
// access this file in ways the shouldn't.  Users may try to type in
// a URL to get around functions that are not being displayed on the
// web page to them. 

include_once 'includes/init.php';

$error = "";
$add = getPostValue( 'add' );
$user = getPostValue( 'user' );
$ufirstname = getPostValue( 'ufirstname' );
$ulastname = getPostValue( 'ulastname' );
$ubirthday = getPostValue( 'ubirthday' );
$ubirthmonth = getPostValue( 'ubirthmonth' );
$ubirthyear = getPostValue( 'ubirthyear' );
$uemail = getPostValue( 'uemail' );
$ubilling_group = getPostValue( 'ubilling_group' );
$upassword1 = getPostValue( 'upassword1' );
$upassword2 = getPostValue( 'upassword2' );
$uis_meal_coordinator = getPostValue( 'uis_meal_coordinator' );
$uis_beancounter = getPostValue( 'uis_beancounter' );
$formtype = getPostValue( 'formtype' );


if ( ! $is_meal_coordinator )
  $user = $login;
$action = getValue ( "action" );

// Handle delete
if ( ( $action == "Delete" || $action == translate ("Delete") ) &&
  $formtype == "edituser" ) {
  if ( $is_meal_coordinator ) {
    if ( $admin_can_delete_user ) {
      user_delete_user ( $user ); // will also delete user's events
    } else {
      $error = translate("Deleting users not supported") . ".";
    }
  } else {
    $error = translate("You are not authorized") . ".";
  }
}

// Handle update of password
else if ( $formtype == "setpassword" && strlen ( $user ) ) {
  if ( $upassword1 != $upassword2 ) {
    $error = translate("The passwords were not identical") . ".";
  } else if ( strlen ( $upassword1 ) ) {
    if ( $user_can_update_password )
      user_update_user_password ( $user, $upassword1 );
    else
      $error = translate("You are not authorized") . ".";
  } else
    $error = translate("You have not entered a password") . ".";
}

// Handle update of user info
else if ( $formtype == "edituser" ) {
  $ubirthdate = sprintf ( "%04d%02d%02d", $birthyear, $birthmonth, $birthday );
  if ( strlen ( $add ) && $is_meal_coordinator ) {
    if ( $upassword1 != $upassword2 ) { 
      $error = translate( "The passwords were not identical" ) . "."; 
    } else {
      if ( addslashes ( $user ) != $user ) {
        // This error should get caught before here anyhow, so
        // no need to translate this.  This is just in case :-)
        $error = "Invalid characters in login.";
      } else if ( empty ( $user ) || $user == "" ) {
        // Username can not be blank. This is currently the only place that 
        // calls user_add_user that is located in $user_inc
        $error = translate( "Username can not be blank" ) . ".";
      } else {
        user_add_user ( $user, $upassword1, $ufirstname, $ulastname, 
          $ubirthdate, $uemail, $ubilling_group, $uis_meal_coordinator, $uis_beancounter );
      }
    }
  } else if ( strlen ( $add ) && ! $is_meal_coordinator ) {
    $error = translate("You are not authorized") . ".";
  } else {
    // Don't allow a user to change themself to an admin or beancounter 
    // by setting uis_meal_coordinator/beancounter in the URL by hand.  
    // They must be admin beforehand.
    if ( ! $is_meal_coordinator ) {
      $uis_meal_coordinator = "N";
      $uis_beancounter = "N";
    }
    user_update_user ( $user, $ufirstname, $ulastname, $ubirthdate,
      $uemail, $ubilling_group, $uis_meal_coordinator, $uis_beancounter );
  }
}

$nextURL = "users.php";

if ( ! empty ( $error ) ) {
  print_header( '', '', '', true );

?>
<h2><?php etranslate("Error")?></h2>
<blockquote>
<?php
echo $error;
//if ( $sql != "" )
//  echo "<br /><br /><strong>SQL:</strong> $sql";
//?>
</blockquote>
</body>
</html>
<?php } else if ( empty ($error) ) {
?><html><head></head><body onload="alert('<?php etranslate("Changes successfully saved");?>'); window.parent.location.href='<?php echo $nextURL;?>';">
</body></html><?php } ?>
