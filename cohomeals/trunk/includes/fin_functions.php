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

function add_financial_event( $billing, $amount, $description, $meal_id, $notes ) {

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
    "( cal_log_id, cal_billing_group, cal_description, " .
    "cal_meal_id, cal_amount, cal_running_balance, " .
    "cal_text ) " . 
    "VALUES (";
  $sql .= $id . ", ";
  $sql .= "'" . $billing . "', ";
  $sql .= "'" . $description . "', ";
  $sql .= $meal_id . ", ";
  $sql .= $amount . ", ";
  $balance += $amount;
  $sql .= $balance . ", ";
  $sql .= "'" . $notes . "'";
  $sql .= " )";
  
  if ( !dbi_query( $sql ) ) 
    $error = "Database error: " . dbi_error ();

}


function auto_financial_event( $meal_id, $action, $type, $user, $subscriber=false ) {

  if ( is_signer( $user ) ) {

    user_load_variables( $user, "temp" );
    
    if ( ($type == 'M') || ($type == 'T') ) {
      if ( $action == 'A' ) {
	$amount = get_price( $meal_id, $user, $subscriber );
	$billing = get_billing_group( $user );
	$description = $GLOBALS[tempfullname] . 
	  " attending meal";
	add_financial_event( $billing, $amount, 
			     $description, $meal_id, "" );
      }
      else if ( $action == 'D' ) {
	$amount = get_refund_price( $meal_id, $user, $subscriber );
	$billing = get_billing_group( $user );
	$description = $GLOBALS[tempfullname] . 
	  " cancelled meal attendance";
	add_financial_event( $billing, $amount, 
			     $description, $meal_id, "" );
      }
      // do nothing if $action == 'C'
    }
  }

}


// fixme: fix subscription method
function get_price( $id, $user, $subscriber=false ) {

  $base_price = 400;
  //// fixme: collect base price  

  
  //// fixme: implement deadlines
  

  //// fixme: implement different subscriber
  if ( $subscriber == true ) 
    $base_price = 350;

  /// check user age
  $sql = "SELECT cal_birthdate " .
    "FROM webcal_user " .
    "WHERE cal_login = '$user'";
  $birthdate = "";
  if ( $res = dbi_query( $sql ) ) {
    $row = dbi_fetch_row( $res );
    $birthdate = $row[0];
    dbi_free_result( $res );
  }

  $free_cutoff = sprintf( "%04d%02d%02d", date( "Y" )-4, date( "m" ), date( "d" ) );
  $child_cutoff = sprintf( "%04d%02d%02d", date( "Y" )-13, date( "m" ), date( "d" ) );

  $cost = $base_price;
  if ( $birthdate > $free_cutoff )
    $cost = 0;
  else if ( $birthdate > $child_cutoff ) 
    $cost = $base_price / 2.0;


  return $cost;
}



/// fixme
function get_refund_price( $id, $user, $subscriber ) {

  $price = get_price( $id, $user, $subscriber );
  $price *= -1;
  return $price;
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
      "FROM webcal_user";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
	$ret[$count++] = $row[0];
      }
    }
  }
  
  return $ret;
}



?>
