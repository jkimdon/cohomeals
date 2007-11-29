<?php
if ( empty ( $PHP_SELF ) && ! empty ( $_SERVER ) &&
  ! empty ( $_SERVER['PHP_SELF'] ) ) {
  $PHP_SELF = $_SERVER['PHP_SELF'];
}
if ( ! empty ( $PHP_SELF ) && preg_match ( "/\/includes\//", $PHP_SELF ) ) {
    die ( "You can't access this file directly!" );
}



function display_financial_log( $cur_group, $startdate, $enddate ) {
  global $billing_group, $is_meal_coordinator, $is_beancounter;
 
  $can_view = false;
  if ( $is_meal_coordinator || $is_beancounter )
    $can_view = true;
  else if ( $billing_group == $cur_group ) 
    $can_view = true;


  if ( $can_view ) {

    echo "<h3>Financial log for $cur_group</h3>";
    echo "<p><table>";
    echo "<tr class=\"d0\">";
    if ( $cur_group == "all" )
      echo "<td> Billing group </td>";
    echo "<td> Date </td>" .
      "<td> Description </td>" .
      "<td> Associated meal </td>" .
      "<td> Notes </td>" .
      "<td> Amount </td>" .
      "<td> Balance </td></tr>";
    $row_num = 1;


    $sql = "SELECT cal_log_id, cal_description, cal_timestamp, cal_meal_id, cal_amount, cal_running_balance, cal_text";

    $start_unixtime = mktime( 0,0,1, 
      substr($startdate,4,2), substr($startdate,6,2), 
      substr($startdate,0,4) );
    $end_unixtime = mktime( 23,59,59, 
      substr($enddate,4,2), substr($enddate,6,2), 
      substr($enddate,0,4) );


    if ( $cur_group == "all" ) 
      $sql .= ", cal_billing_group FROM webcal_financial_log " .
	"WHERE cal_timestamp >= FROM_UNIXTIME($start_unixtime) " .
	"AND cal_timestamp <= FROM_UNIXTIME($end_unixtime)";
    else
      $sql .= " FROM webcal_financial_log " . 
	"WHERE cal_billing_group='$cur_group'" .
	"AND cal_timestamp >= FROM_UNIXTIME($start_unixtime) " .
	"AND cal_timestamp <= FROM_UNIXTIME($end_unixtime)";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
	$log_id = $row[0];
	$description = $row[1];
	$time = $row[2];
	$meal_id = $row[3];
	$amount = $row[4];
	$balance = $row[5];
	$text = $row[6];

	echo "<tr class=\"d$row_num\">";
	if ( $cur_group == "all" ) 
	  echo "<td>" . htmlspecialchars( $row[7] ) . "</td.";
	echo "<td>$time</td>" .
	  "<td>" . htmlspecialchars( $description ) . "</td>";
	if ( $meal_id > 0 ) {
	  $sql2 = "SELECT cal_date, cal_suit " .
	    "FROM webcal_meal WHERE cal_id = $meal_id";
	  if ( $res2 = dbi_query( $sql2 ) ) {
	    if ( $row2 = dbi_fetch_row( $res2 ) ) {
	      $meal_date = $row2[0];
	      $suit = $row2[1];
	      echo "<td><a href=\"view_entry.php?id=" . 
		$meal_id . "\">" . 
		$suit . " meal on " .
	      date_to_str( $meal_date, "", false, true, "" ) . 
		"</a></td>";
	    }
	  }
	} else {
	  echo "<td>None</td>";
	}
	echo "<td>" . htmlspecialchars( $text ) . "</td>";
	$sign = "";
	if ( $amount < 0 ) {
	  $amount *= -1.0;
	  $sign = "-";
	}
	echo "<td align=right>" .
	  sprintf( "%s$%01.2f", $sign, $amount/100 ) . 
	  "</td>";
	$sign = "";
	if ( $balance < 0 ) {
	  $balance *= -1.0;
	  $sign = "-";
	}
	echo "<td align=right>" .
	  sprintf( "%s$%01.2f", $sign, $balance/100 ) . 
	  "</td>";
	echo "</tr>";
	$row_num = ( $row_num == 1 ) ? 0:1;
      }
    }
    echo "</table>";
  }

}

function add_financial_event( $user, $billing, $amount, $type, $description, $meal_id, $notes ) {

  $balance = 0;
  $last_balance = 0;

  $sql = "SELECT cal_amount, cal_running_balance " .
    "FROM webcal_financial_log " . 
    "WHERE cal_billing_group = '$billing' ".
    "ORDER BY cal_timestamp";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $balance += $row[0];
      $last_balance = $row[1];
    }
    dbi_free_result( $res );
  }

  if ( $last_balance != $balance ) {
    $error = "mismatched balance";
  }


  $sql = "SELECT MAX(cal_log_id) FROM webcal_financial_log";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) 
      $id = $row[0] + 1;
    dbi_free_result( $res );
  }

  
  $sql = "INSERT INTO webcal_financial_log " .
    "( cal_log_id, cal_login, cal_billing_group, cal_description, " .
    "cal_meal_id, cal_amount, cal_running_balance, " .
    "cal_text ) " . 
    "VALUES (";
  $sql .= $id . ", ";
  $sql .= "'" . $user . "', ";
  $sql .= "'" . $billing . "', ";
  $sql .= "'" . $description . "', ";
  $sql .= $meal_id . ", ";
  if ( ($type == 'charge') && ($amount > 0) ) $amount *= -1;
  else if ( ($type == 'credit') && ($amount < 0) ) $amount *= -1;
  $sql .= $amount . ", ";
  $balance += $amount;
  $sql .= $balance . ", ";
  $sql .= "'" . $notes . "'";
  $sql .= " )";
  
  if ( !dbi_query( $sql ) ) 
    $error = "Database error: " . dbi_error ();

}


function auto_financial_event( $meal_id, $action, $type, $user ) {

  if ( is_signer( $user ) ) {

    user_load_variables( $user, "temp" );

    /// determine if subscriber
    $event_date = date( "Ymd" );
    $subscriber = false;
    $sql = "SELECT cal_date FROM webcal_meal WHERE cal_id=$meal_id";
    if ( $res = dbi_query( $sql ) ) {
      if ( $row = dbi_fetch_row( $res ) ) {
	$event_date = $row[0];
	$sql2 = "SELECT cal_login " .
	  "FROM webcal_subscriptions " .
	  "WHERE cal_login = '$user' " . 
	  "AND cal_start <= $event_date " .
	  "AND cal_end > $event_date";
	if ( $res2 = dbi_query( $sql2 ) ) {
	  if ( dbi_fetch_row( $res2 ) ) {
	    $subscriber = true;
	  }
	  dbi_free_result( $res2 );
	}
      }
      dbi_free_result( $res );
    }

    
    if ( ($type == 'M') || ($type == 'T') ) {
      if ( $action == 'A' ) {
	$amount = get_price( $meal_id, $user, $subscriber );
	$billing = get_billing_group( $user );
	$description = $GLOBALS[tempfullname] . 
	  " dining";
	add_financial_event( $user, $billing, $amount, "charge",
			     $description, $meal_id, "" );
      }
      else if ( $action == 'D' ) {
	$amount = get_refund_price( $meal_id, $user, $subscriber );
	$billing = get_billing_group( $user );
	$description = $GLOBALS[tempfullname] . 
	  " cancelled meal attendance";
	add_financial_event( $user, $billing, $amount, "credit",
			     $description, $meal_id, "" );
      }
      // do nothing if $action == 'C'
    }
  }

}



function get_price( $id, $user, $subscriber=false ) {

  /// establish price category based on age
  $age = "A";
  $sql = "SELECT cal_birthdate " .
    "FROM webcal_user " .
    "WHERE cal_login = '$user'";
  $birthdate = "";
  if ( $res = dbi_query( $sql ) ) {
    $row = dbi_fetch_row( $res );
    $birthdate = $row[0];
    dbi_free_result( $res );
  }

  $age = get_fee_category( $birthdate );

  $cost = get_adjusted_price ( $id, $age, $subscriber );
  return $cost;
}



function get_fee_category( $birthdate ) {

  $free_cutoff = sprintf( "%04d%02d%02d", date( "Y" )-4, date( "m" ), date( "d" ) );
  $child_cutoff = sprintf( "%04d%02d%02d", date( "Y" )-13, date( "m" ), date( "d" ) );

  $age = "A";
  if ( $birthdate > $free_cutoff )
    $age = "F";
  else if ( $birthdate > $child_cutoff ) 
    $age = "C";
  else $age = "A";

  return $age;
}


function get_adjusted_price( $id, $fee_class, 
			     $subscriber=false, $guest=false ) {

  /// get meal details. establish base price, past_deadline
  $base_price = 400;
  $past_deadline = true;
  $sql = "SELECT cal_base_price, cal_date, cal_signup_deadline " .
    "FROM webcal_meal " .
    "WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $base_price = $row[0];
      $event_date = $row[1];
      $deadline = $row[2];
      $signup_deadline = get_day( $event_date, -1*$deadline );
      if ( $signup_deadline >= date("Ymd") ) $past_deadline = false;
    }
  }


  /// establish price category based on preregistration or walkin
  $category = "pre";
  if ( $past_deadline == true ) $category = "walkin";
  if ( $guest == true ) $category = "walkin";


  /// calculate cost based on above information
  $cost = $base_price;
  if ( $category == "walkin" ) $cost += 100;
  else if ( $subscriber == true ) $cost = $base_price * 0.875;

  if ( $fee_class == "F" ) $cost = 0;
  else if ( $fee_class == "C" ) $cost /= 2;

  return $cost;
}





function get_refund_price( $id, $user, $subscriber=false ) {

  $price = 0;
  $past_deadline = true;
  $today = date( "Ymd" );

  $sql = "SELECT cal_date, cal_signup_deadline " .
    "FROM webcal_meal " .
    "WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $event_date = $row[0];
      $deadline = $row[1];
      $deadline_date = get_day( $event_date, -1*$deadline );
      if ( $deadline_date >= $today ) $past_deadline = false;
    }
    dbi_free_result( $res );
  }



  if ( $past_deadline == false ) {
    $percentage = get_refund_percentage( $id, $past_deadline );

    $maxT = 0;
    $amount = 0;
    $sql = "SELECT cal_amount, cal_timestamp " .
      "FROM webcal_financial_log " .
      "WHERE cal_login = '$user' " . 
      "AND cal_meal_id = $id " .
      "AND cal_amount < 0";
    if ( $res = dbi_query( $sql ) ) {
      if ( $row = dbi_fetch_row( $res ) ) {
	$timestamp = $row[1];
	if ( $timestamp > $maxT ) {
	  $maxT = $timestamp;
	  $amount = $row[0];
	}
      }
      dbi_free_result( $res );
    }
	  

    $amount *= $percentage;
    $amount /= 100;
    $price = (int)$amount;
  } // else: leave price == 0.

  return $price;
}


function get_guest_refund_price( $id, $host, $guest_name ) {

  $price = 0;
  $past_deadline = true;
  $today = date( "Ymd" );

  $sql = "SELECT cal_date, cal_signup_deadline " .
    "FROM webcal_meal " .
    "WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $event_date = $row[0];
      $deadline = $row[1];
      $deadline_date = get_day( $event_date, -1*$deadline );
      if ( $deadline_date >= $today ) $past_deadline = false;
    }
    dbi_free_result( $res );
  }



  if ( $past_deadline == false ) {
    $percentage = get_refund_percentage( $id, $past_deadline );

    $maxT = 0;
    $amount = 0;
    $sql = "SELECT cal_amount, cal_timestamp " .
      "FROM webcal_financial_log " .
      "WHERE cal_login = '$host' " . 
      "AND cal_meal_id = $id " .
      "AND cal_description LIKE '%$guest_name%' " .
      "AND cal_amount < 0";
    if ( $res = dbi_query( $sql ) ) {
      if ( $row = dbi_fetch_row( $res ) ) {
	$timestamp = $row[1];
	if ( $timestamp > $maxT ) {
	  $maxT = $timestamp;
	  $amount = $row[0];
	}
      }
      dbi_free_result( $res );
    }
	  

    $amount *= $percentage;
    $amount /= 100;
    $price = (int)$amount;
  } // else: leave price == 0.

  return $price;
}


function get_refund_percentage( $id, $past_deadline=false ) {

  $refund = 100;

  $suit = 'wild';
  $today = date( "Ymd" );
  $event_date = $today;
  $sql = "SELECT cal_suit, cal_date " .
    "FROM webcal_meal " .
    "WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $suit = $row[0];
      $event_date = $row[1];
    }
  }

  if ( ($past_deadline == true) && ($suit != 'heart') ) {
    $refund = 0;
  } else {

    if ( $suit == 'heart' ) {
      $two_weeks_before = get_day( $event_date, -14 );
      $two_days_before = get_day( $event_date, -2 );
      if ( $today > $two_weeks_before ) {
	if ( $today > $two_days_before ) 
	  $refund = 0;
	else
	  $refund = 50;
      }
    }
  }


  return $refund;
}



function price_to_str( $price ) {
  $dollars = (int)($price / 100);
  $cents = $price - ($dollars*100);
  printf( "\$%d.%02d", $dollars, $cents );
}



function get_billing_group( $user ) {
  global $is_meal_coordinator, $is_beancounter;

  $ret = "";
  if ( is_signer( $user ) ) {

    $sql = "SELECT cal_billing_group " .
      "FROM webcal_user " .
      "WHERE cal_login = '$user'";
    if ( $res = dbi_query( $sql ) ) {
      if ( $row = dbi_fetch_row( $res ) ) {
	$ret = $row[0];
      }
    }
  }
  
  return $ret;
}

function get_billing_groups() {
  global $is_meal_coordinator, $is_beancounter;

  $ret = array();
  $count = 0;

  if ( $is_beancounter || $is_meal_coordinator ) {

    $sql = "SELECT DISTINCT cal_billing_group " .
      "FROM webcal_user " .
      "ORDER BY cal_billing_group";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
	$ret[$count++] = $row[0];
      }
    }
  }
  
  return $ret;
}



?>
