<?php
include_once 'includes/init.php';

$id = mysql_safe( getValue( 'meal_id' ), false );

if ( paperwork_done( $id ) ) {
  echo "Paperwork for this meal has already been completed and cannot be resubmitted. Email Joey if you need to make changes.<br>";
} else {


if ( $is_meal_coordinator || $is_beancounter || is_chef( $id, $login ) ) {


  //////////////////////
  /// charge walkins

  /// members
  $names = user_get_users();
  foreach ( $names as $name ) {
    $username = $name['cal_login'];
    $walkin = getValue( $username );
    if ( $walkin == true ) {
      edit_participation( $id, 'A', 'M', $username, 1 );
    }
  }

  /// guests
  for ( $i=0; $i<7; $i++ ) {
    $key = "newguest$i";
    $guest_name = mysql_safe( getValue( $key ), true );
    if ( $guest_name != "" ) {
      $key = "host$i";
      $host = mysql_safe( getValue( $key ), true );
      if ( $host == "" || $host == "none" ) { // make sure somebody's charged
	user_load_variables( $login, 'default_' ); 
	$host = $GLOBALS['default_login'];
      }
      $key = "fee$i";
      $fee_class = mysql_safe( getValue( $key ), true );
      // add as diner to the database
      $sql = "INSERT INTO webcal_meal_guest " .
	"( cal_meal_id, cal_fullname, cal_host, cal_fee, cal_type, cal_walkin ) " .
	"VALUES ( $id, '$guest_name', '$host', '$fee_class', 'M', 1 )";
      if ( !dbi_query( $sql ) ) {
	$error = "Database entry failed";
      }
      
      
      // charge host's account
      $amount = get_adjusted_price( $id, $fee_class, true );
      $billing = get_billing_group( $host );
      $description = "Guest: $guest_name dining (walkin)";
      add_financial_event( $host, $billing, $amount, "charge",
			   $description, $id, "" );


    }
  }


  //////////////////////
  /// enter food expenditures for shoppers into table
  for ( $i=0; $i<3; $i++ ) {
    $key = "shopper$i";
    $shopper = mysql_safe( getValue( $key ), true );

    if ( $shopper != 'none' ) {
      $key = "vendor$i";
      $vendor = mysql_safe( getValue( $key ), true );
      
      $key = "dollars$i";
      $dollars = mysql_safe( getValue( $key ), true );
      
      $key = "cents$i";
      $cents = mysql_safe( getValue( $key ), true );
      
      $amount = 100*$dollars + $cents;
      
      $res = dbi_query( "SELECT MAX( cal_log_id ) FROM webcal_food_expenditures" );
      if ( $res ) {
	$row = dbi_fetch_row ( $res );
	$log_id = $row[0] + 1;
	dbi_free_result ( $res );
      } else {
	$log_id = 1;
      }
      
      $sql = "INSERT INTO webcal_food_expenditures " .
	"( cal_log_id, cal_purchaser, cal_amount, cal_meal_id, cal_source ) " .
	"VALUES ( $log_id, '$shopper', $amount, $id, '$vendor' )";
      if ( !dbi_query( $sql ) ) {
	$error = "Database entry failed";
      }

    }
  }


  //////////////////////
  /// enter farmer's market
  $farmersDollars = mysql_safe( getValue( 'farmersDollars' ), true );
  $farmersCents = mysql_safe( getValue( 'farmersCents' ), true );
  if ( ($farmersDollars != "") && ($farmersCents != "") ) {

    $cents = 100*$farmersDollars + $farmersCents;
    
    $res = dbi_query( "SELECT MAX( cal_log_id ) FROM webcal_pantry_purchases" );
    if ( $res ) {
      $row = dbi_fetch_row ( $res );
      $log_id = $row[0] + 1;
      dbi_free_result ( $res );
    } else {
      $log_id = 1;
    }
    
    $sql = "SELECT cal_food_id FROM webcal_pantry_food " .
      "WHERE cal_description = 'farmers market'";
    if ( $res = dbi_query( $sql ) ) {
      if ( $row = dbi_fetch_row( $res ) ) {
	$food_id = $row[0];
      } 
      else echo "dbi error: " . dbi_error() . "<br>\n";
    }
    else echo "dbi error: " . dbi_error() . "<br>\n";  
    
    
    $sql = "INSERT INTO webcal_pantry_purchases " .
      "( cal_log_id, cal_food_id, cal_number_units, cal_total_price, cal_type, cal_meal_id ) " .
      "VALUES ( $log_id, $food_id, $cents, $cents, 1, $id )";
    if ( !dbi_query( $sql ) ) {
      $error = "Database entry failed";
    }
  }


  //////////////////////
  /// enter flat rate
  $diners = 0;
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND (cal_type = 'M' OR cal_type = 'T')";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $diners++;
    }
  }
  $sql = "SELECT cal_fullname FROM webcal_meal_guest " .
    "WHERE cal_meal_id = $id AND (cal_type = 'M' OR cal_type = 'T')";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $diners++;
    }
  }
  $cents = 10 * $diners;


  $sql = "SELECT cal_food_id FROM webcal_pantry_food " .
    "WHERE cal_description = 'flat rate'";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $food_id = $row[0];
    } 
    else echo "dbi error: " . dbi_error() . "<br>\n";
  }
  else echo "dbi error: " . dbi_error() . "<br>\n";  


  $res = dbi_query( "SELECT MAX( cal_log_id ) FROM webcal_pantry_purchases" );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    $log_id = $row[0] + 1;
    dbi_free_result ( $res );
  } else {
    $log_id = 1;
  }


  $sql = "INSERT INTO webcal_pantry_purchases " .
    "( cal_log_id, cal_food_id, cal_number_units, cal_total_price, cal_type, cal_meal_id ) " .
    "VALUES ( $log_id, $food_id, $cents, $cents, 1, $id )";
  if ( !dbi_query( $sql ) ) {
    $error = "Database entry failed";
  }



  //////////////////////
  /// enter pantry purchases into table
  $sql = "SELECT cal_food_id, cal_unit_price FROM webcal_pantry_food " .
    "WHERE cal_available_meals = 1";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $amount = 0;
      $food_id = $row[0];
      $key = "amount$food_id";
      $amount = getValue( $key ) * 100;
      $amount_safe = mysql_safe( $amount, false ) / 100.00;
      $price = $row[1];
      $total_price = $price * $amount_safe;

      if ( $amount > 0 ) {
	$res2 = dbi_query( "SELECT MAX( cal_log_id ) FROM webcal_pantry_purchases" );
	if ( $res2 ) {
	  $row2 = dbi_fetch_row ( $res2 );
	  $log_id = $row2[0] + 1;
	  dbi_free_result ( $res2 );
	} else {
	  $log_id = 1;
	}

	$sql3 = "INSERT INTO webcal_pantry_purchases " .
	  "( cal_log_id, cal_food_id, cal_number_units, cal_total_price, cal_type, cal_meal_id ) " .
	  "VALUES ( $log_id, $food_id, $amount, $total_price, 1, $id )";
	if ( !dbi_query( $sql3 ) ) {
	  $error = "Database entry failed";
	}
      }
      
    }
  }



  //////////////////////
  /// display results: amount spent, income, link to reimbursement form
  $nexturl = "display_meal_summary.php?id=$id";
  do_redirect( $nexturl );


} else {
  echo "Not authorized<br>";
}

}

print_header();

print_trailer();
?>
</body>
</html>

