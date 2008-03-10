<?php
if ( empty ( $PHP_SELF ) && ! empty ( $_SERVER ) &&
  ! empty ( $_SERVER['PHP_SELF'] ) ) {
  $PHP_SELF = $_SERVER['PHP_SELF'];
}
if ( ! empty ( $PHP_SELF ) && preg_match ( "/\/includes\//", $PHP_SELF ) ) {
    die ( "You can't access this file directly!" );
}


function collect_financial_log( $cur_group, $startdate, $enddate, $sortbymeal ) {

  $selected_logs = array ();
  $ordered_logs = array ();
  $ordering = array ();
  $count = 0;

  if ( $sortbymeal == false ) {

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
	$ordered_logs[$count]['log_id'] = $row[0];
	$ordered_logs[$count]['description'] = $row[1];
	$ordered_logs[$count]['time'] = $row[2];
	$meal_id = $row[3];
	$ordered_logs[$count]['meal_id'] = $meal_id;
	$ordered_logs[$count]['amount'] = $row[4];
	$ordered_logs[$count]['balance'] = $row[5];
	$ordered_logs[$count]['text'] = $row[6];
	if ( $cur_group == "all" ) $ordered_logs[$count]['billing_group'] = $row[7];
	$count++;
      }
    }
  } else { // sorting by meal

    $sql = "SELECT cal_log_id, cal_description, cal_timestamp, cal_meal_id, cal_amount, cal_running_balance, cal_text";    
    if ( $cur_group == "all" ) 
      $sql .= ", cal_billing_group FROM webcal_financial_log " .
	"ORDER BY cal_billing_group, cal_timestamp";
    else 
      $sql .= " FROM webcal_financial_log " .
	"WHERE cal_billing_group = '$cur_group' " .
	"ORDER BY cal_timestamp";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
	$meal_id = $row[3];

	$sql2 = "SELECT cal_date FROM webcal_meal " .
	  "WHERE cal_id = $meal_id";
	$res2 = dbi_query( $sql2 );
	$row2 = dbi_fetch_row( $res2 );
	$date = $row2[0];


	if ( ($date >= $startdate) && ($date <= $enddate) ) {
	  $selected_logs[$count]['log_id'] = $row[0];
	  $selected_logs[$count]['description'] = $row[1];
	  $selected_logs[$count]['date'] = $date;
	  $selected_logs[$count]['time'] = $row[2];
	  $selected_logs[$count]['meal_id'] = $meal_id;
	  $selected_logs[$count]['amount'] = $row[4];
	  $selected_logs[$count]['balance'] = $row[5];
	  $selected_logs[$count]['text'] = $row[6];
	  if ( $cur_group == "all" ) $selected_logs[$count]['billing_group'] = $row[7];

	  $ordering[$count] = $date;

	  $count++;
	}
      }
    }

    $newcount = 0;
    asort( $ordering );
    $ct = 0;
    $day_log = array();
    foreach ( $ordering as $key => $value ) {
      $thisdate = $selected_logs[$key]['date'];
      if ( $ct == 0 )
	$prevdate = $thisdate;
      if ( $prevdate != $thisdate ) {
	sort( $day_log );
	foreach ( $day_log as $dkey => $dvalue )
	  $ordered_logs[$newcount++] = $selected_logs[$dvalue];
	$ct = 0;
	$day_log = array();
      }
      $day_log[$ct++] = $key;
      $prevdate = $thisdate;
    }
    sort( $day_log );
    foreach ( $day_log as $dkey => $dvalue )
      $ordered_logs[$newcount++] = $selected_logs[$dvalue];
    dbi_free_result( $res );
  }

  return $ordered_logs;
}
				


function display_financial_log( $cur_group, $sortbymeal, $ordered_logs ) {
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
    echo "<td> Transaction date </td>" .
      "<td> Description </td>" .
      "<td> Associated meal </td>" .
      "<td> Notes </td>" .
      "<td> Amount </td>";
    if ( $sortbymeal == false ) echo "<td> Balance </td></tr>";
    $row_num = 1;


    foreach ( $ordered_logs as $log ) {

      echo "<tr class=\"d$row_num\">";
      if ( $cur_group == "all" ) 
	echo "<td>" . htmlspecialchars( $log['billing_group'] ) . "</td.";
      echo "<td>" . $log['time'] . "</td>";
      echo "<td>" . htmlspecialchars( $log['description'] ) . "</td>";
      $meal_id = $log['meal_id'];
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
      echo "<td>" . htmlspecialchars( $log['text'] ) . "</td>";
      echo "<td align=right>" . price_to_str( $log['amount'] ) . "</td>";
      if ( $sortbymeal == false ) 
	echo "<td align=right>" . price_to_str( $log['balance'] ) . "</td>";
      echo "</tr>";
      $row_num = ( $row_num == 1 ) ? 0:1;
    }
  }
  echo "</table>";

}

function add_financial_event( $user, $billing, $amount, $type, $description, $meal_id, $notes ) {

  $balance = 0;
  $last_balance = 0;
  $last_time = 0;

  $sql = "SELECT cal_amount, cal_running_balance, cal_timestamp " .
    "FROM webcal_financial_log " . 
    "WHERE cal_billing_group = '$billing' ".
    "ORDER BY cal_log_id";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $balance += $row[0];
      $last_balance = $row[1];
      $last_time = $row[2];
    }
    dbi_free_result( $res );
  }

  if ( $last_balance != $balance ) {
    $error = "mismatched balance: " . 
      "at time $last_time, balance = $last_balance; " .
      "balance sum = $balance<br>";
    echo $error;
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
    $subscriber = is_subscriber( $meal_id, $user );
    
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



function give_heart_discount( $id, $user ) {
  if ( is_signer ( $user ) ) {
    $full_amount = get_price( $id, $user, false );
    $discount_amount = get_price( $id, $user, true );
    $discount = $full_amount - $discount_amount;

    user_load_variables( $user, "temp" );
    $description = $GLOBALS[tempfirstname] . ": Heart discount";

    add_financial_event( $user, get_billing_group( $user ), $discount, "credit",
			 $description, $id, "" );
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
    if ( $row = dbi_fetch_row( $res ) ) {
      $birthdate = $row[0];
      dbi_free_result( $res );
    }
  }

  $sql = "SELECT cal_date " . 
    "FROM webcal_meal " .
    "WHERE cal_id = $id";
  $event_date = date( "Ymd" );
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $event_date = $row[0];
      dbi_free_result( $res );
    }
  }

  $age = get_fee_category( $birthdate, $event_date );

  $cost = get_adjusted_price ( $id, $age, $subscriber, false, $user );
  return $cost;
}



function get_fee_category( $birthdate, $event_date ) {

  $epoch = date_to_epoch( $event_date );
  $free_cutoff = sprintf( "%04d%02d%02d", date( "Y", $epoch )-4, 
			  date( "m", $epoch ), date( "d", $epoch ) );
  $child_cutoff = sprintf( "%04d%02d%02d", date( "Y", $epoch )-13, 
			   date( "m", $epoch ), date( "d", $epoch ) );

  $age = "A";
  if ( $birthdate > $free_cutoff )
    $age = "F";
  else if ( $birthdate > $child_cutoff ) 
    $age = "K";
  else $age = "A";

  return $age;
}


function get_adjusted_price( $id, $fee_class, 
			     $subscriber=false, $guest=false,
			     $user="") {

  /// get meal details. establish base price, past_deadline
  $base_price = 400;
  $past_deadline = true;
  $suit = "wild";
  $sql = "SELECT cal_base_price, cal_date, " . 
    "cal_signup_deadline, cal_suit " .
    "FROM webcal_meal " .
    "WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $base_price = $row[0];
      $event_date = $row[1];
      $deadline = $row[2];
      $suit = $row[3];
      $signup_deadline = get_day( $event_date, -1*$deadline );
      if ( $signup_deadline >= date("Ymd") ) $past_deadline = false;
    }
  }


  /// establish price category based on preregistration or walkin
  $category = "pre";
  if ( $user != '' ) {
    if ( is_walkin( $id, $user ) == 1 ) $category = "walkin";
  } else {
    if ( $past_deadline == true ) $category = "walkin";
  }
  if ( $guest == true ) $category = "walkin";


  /// calculate cost based on above information
  $cost = $base_price;
  if ( $category == "walkin" ) $cost += 100;
  else if ( ($subscriber == true) && ($suit == "heart") ) 
    $cost = $base_price * 0.875;

  if ( $fee_class == "F" ) $cost = 0;
  else if ( $fee_class == "K" ) $cost /= 2;

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


  $percentage = get_refund_percentage( $id, $past_deadline );
  if ( $percentage != 0 ) {

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

  if ( $past_deadline == true ) {
    $refund = 0;
  } 

  return $refund;
}


function get_money_for_meal( $id ) {
  $total = 0;

  $sql = "SELECT cal_amount FROM webcal_financial_log " .
    "WHERE cal_meal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $total += $row[0];
    }
    dbi_free_result( $res );
  }
  $total *= -1;

  return $total;
}


function price_to_str( $price ) {
  $sign = "";
  if ( $price < 0 ) {
    $price *= -1.0;
    $sign = "-";
  }
  $dollars = (int)($price / 100);
  $cents = $price - ($dollars*100);
  $ret = sprintf( "%s\$%d.%02d", $sign, $dollars, $cents );
  return $ret;
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
