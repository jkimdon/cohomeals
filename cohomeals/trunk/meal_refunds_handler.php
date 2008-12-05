<?php
include_once 'includes/init.php';

$club_id = 0;
$club_id = mysql_safe( getValue( 'club_id' ), false );
$meal_id = 0;
$meal_id = mysql_safe( getValue( 'meal_id' ), false );


// go through each signed up person to see if they should be removed
$sql = "SELECT cal_login FROM webcal_meal_participant " . 
 "WHERE (cal_type = 'M' OR cal_type = 'T') AND cal_id = $meal_id";
if ( $res = dbi_query( $sql ) ) { 
  while ( $row = dbi_fetch_row( $res ) ) {
    $current_user = $row[0];
    user_load_variables( $current_user, "temp" );
    $name = $GLOBALS[tempfullname];

    /// check if club, see if more than one meal
    $sql2 = "SELECT cal_suit, cal_club_id FROM webcal_meal " .
      "WHERE cal_id = $meal_id";
    $res2 = dbi_query( $sql2 );
    $row2 = dbi_fetch_row( $res2 );
    $meal_ids = array();
    $meal_ids[0] = $meal_id;
    if ( $row2[0] == 'club' ) {
      $club_id = $row2[1];
      $sql3 = "SELECT cal_id FROM webcal_meal " .
	"WHERE cal_club_id = $club_id AND cal_cancelled = 0";
      $res3 = dbi_query( $sql3 );
      $i = 0;
      while ( $row3 = dbi_fetch_row( $res3 ) ) {
	$meal_ids[$i] = $row3[0];
	$i++;
      }
    }
    
    for ( $i=0; $i<count($meal_ids); $i++ ) {
      $cur_id = $meal_ids[$i];
      
      $to_refund = false;
      $to_refund = getValue( $current_user );
      if ( $to_refund == true ) {
	echo "Refunding $name<br>";
	
	// remove from meal
	if ( is_dining( $cur_id, $current_user ) ) {
	  $sql4 = "DELETE FROM webcal_meal_participant " .
	    "WHERE cal_id = $cur_id AND cal_login = '$current_user' " .
	    "AND cal_type = 'M' OR cal_type = 'T'";
	  dbi_query( $sql4 );
	}
	
	// refund
	$amount = get_refund_price( $cur_id, $current_user, false );
	$billing = get_billing_group( $current_user );
	$description = $name . " refunded for meal";
	add_financial_event( $current_user, $billing, $amount, "credit", 
			     $description, $cur_id, "" );
      }
    }

  }
 }


?>
