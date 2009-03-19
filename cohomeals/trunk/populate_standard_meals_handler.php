<?php
include_once 'includes/init.php';
include_once 'includes/config.php';

load_global_settings();


if ( $is_meal_coordinator ) {

  $month_date = mysql_safe( getValue( "month" ), false );
  $addpeople = mysql_safe( getValue( "addpeople" ), false );

  $thisyear = substr( $month_date, 0, 4 );
  $thismonth = substr( $month_date, 4, 2 );

  if ( $addpeople == 1 ) {
    $body = "This is the monthly email to check head chef dates for " . 
      date_to_str( $month_date, "__month__", false ) . ".\n\n";
    $body .= "To people who aren't regular crew/chefs: Please check to see if any of
the crew or chef openings below work for you this month. Many head
chefs feel more at ease if they know ahead of time that they'll have
enough crew.\n\n";
    $body .= "To head chefs and regular crew: Please verify whether or not the dates
below work for you.\n\n";
    $body .= "- Joey\n\n";
    $body .= "*************************************\n\n";
    $body .= date_to_str( $month_date, "__month__", false ) . ":\n\n";
  }





  ///////////// step through each day in the month

  $wkstart = get_sunday_before ( $thisyear, $thismonth, 1 );

  // generate values for first day and last day of month
  $monthstart = mktime ( 3, 0, 0, $thismonth, 1, $thisyear );
  $monthend = mktime ( 3, 0, 0, $thismonth + 1, 0, $thisyear );


  $which_week = 1;
  if ( $addpeople == 1 ) 
    $body .= "Week $which_week\n";
  $day_count = 0;
  for ( $i = $wkstart; date ( "Ymd", $i ) <= date ( "Ymd", $monthend ); $i += ( 24 * 3600 * 7 ) ) {
    for ( $j = 0; $j < 7; $j++ ) { // step through a week starting on Sunday, marked by $i
      $date = $i + ( $j * 24 * 3600 );
      if ( date ( "Ymd", $date ) >= date ( "Ymd", $monthstart ) &&
	   date ( "Ymd", $date ) <= date ( "Ymd", $monthend ) ) {
	if ( $day_count == 7 ) {
	  $which_week++;
	  $day_count = 0;
	  if ( $addpeople == 1 ) 
	    $body .= "\n Week $which_week\n";
	}
	$thiswday = date ( "w", $date );
	$day_count++;


	// start with any monthly modified version
	$sql = "SELECT cal_time, cal_suit, cal_base_price, cal_menu, " .
	  "cal_head_chef, cal_regular_crew " . 
	  "FROM webcal_standard_meals " .
	  "WHERE cal_temp_change = $month_date AND cal_day_of_week = $thiswday " .
	  "AND cal_which_week = $which_week";
	if ( $res = dbi_query( $sql ) ) {
	  if ( $row = dbi_fetch_row( $res ) ) {
	    // insert_meal checks to see if there's already a meal then
	    $mealid = insert_meal( $date, $row[0], $row[1], $row[2], $row[3] ); 
	    if ( $addpeople == 1 ) {
	      print_crew( $mealid, $date );
	      insert_crew( $mealid, $row[4], $row[5] );
	    }
	  } 
	  else { // check for a non-modified version
	    $sql2 = "SELECT cal_time, cal_suit, cal_base_price, cal_menu, " .
	      "cal_head_chef, cal_regular_crew " . 
	      "FROM webcal_standard_meals " .
	      "WHERE cal_temp_change = 0 AND cal_day_of_week = $thiswday " .
	      "AND cal_which_week = $which_week";
	    if ( $res2 = dbi_query( $sql2 ) ) {
	      if ( $row2 = dbi_fetch_row( $res2 ) ) {
		$mealid = insert_meal( $date, $row2[0], $row2[1], $row2[2], $row2[3] );
		if ( $addpeople == 1 ) {
		  $head_chef = $row2[4];
		  $crew = $row2[5];
		  print_crew( $mealid, $date );
		  insert_crew( $mealid, $head_chef, $crew );
		}
	      }
	    } // else do not add anything for this day of the week and week number
	  }
	}
      }
    }
  }


  if ( $addpeople == 1 ) {
    $body .= "\n\n crew call list: (head chefs can call these people if they need more help)\n\n";
    $body .= "Val (esp Saturdays)\n" .
      "Mike (esp last minute help)\n" .
      "Amaris\n" .
      "Dave D\n" .
      "Marcy\n";

    $extra_hdrs = "From: " . $GLOBALS['weekly_reminder_from'] . "\r\n";

    mail( $GLOBALS['weekly_reminder_from'],
	  "Monthly head chef allocation", $body, $extra_hdrs );
    //    echo "email = $body<br>";

  }


  $nexturl = "populate_standard_meals.php?month=$month_date";
  do_redirect( $nexturl );

 } else {
  echo "Not authorized<br>";
 }



print_header();

print_trailer();
?>
</body>
</html>



<?php 
function insert_meal( $date, $time, $suit, $price, $menu ) {

  $formatted_date = date( "Ymd", $date );

  // first make sure the meal isn't already there
  $sql = "SELECT cal_id, cal_base_price FROM webcal_meal " .
    "WHERE cal_suit = '$suit' AND cal_date = $formatted_date";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $mealid = $row[0];
      $old_price = $row[1];

      // if there's already a head chef, assume changes have been made and do not change further
      if ( $head_chef == "" ) {

	// reset time (may be different according to who is head chef this month)
	$sql2 = "UPDATE webcal_meal SET cal_time = $time WHERE cal_id = $mealid";
	dbi_query( $sql2 );


	// check to see if the price is different (may be according to who is head chef this month)
	if ( $old_price != $price ) {

	  // check to see if anybody's signed up yet and refund/charge them to bring to current price


	  // check members
	  $sql2 = "SELECT cal_login FROM webcal_meal_participant " . 
	    "WHERE cal_id = $mealid AND (cal_type = 'M' OR cal_type = 'T') ";
	  if ( $res2 = dbi_query( $sql2 ) ) {
	    while ( $row2 = dbi_fetch_row( $res2 ) ) {
	      $financial_user = $row2[0];
	      $billing = get_billing_group( $financial_user );
	      $refund_price = get_refund_price( $mealid, $financial_user, false );
	      $description = "base price change: refund";
	      add_financial_event( $financial_user, $billing, $refund_price, "credit",
				   $description, $mealid, "" );
	    }
	  }
	  // check guests that haven't already been refunded above by a host dining
	  $sql2 = "SELECT cal_host, cal_fullname FROM webcal_meal_guest " . 
	    "WHERE cal_meal_id = $mealid AND (cal_type = 'M' OR cal_type = 'T') ";
	  if ( $res2 = dbi_query( $sql2 ) ) {
	    while ( $row2 = dbi_fetch_row( $res2 ) ) {
	      $financial_user = $row2[0];
	      $guest_name = $row2[1];
	      
	      $sql3 = "SELECT cal_login FROM webcal_meal_participant " .
		"WHERE cal_id = $mealid AND (cal_type = 'M' OR cal_type = 'T') ";
	      if ( $res3 = dbi_query( $sql3 ) ) {
		if ( !($row3 = dbi_fetch_row( $res3 )) ) { 
		  // i.e. if they haven't already been refunded above
		  $billing = get_billing_group( $financial_user );
		  $refund_price = get_guest_refund_price( $mealid, $financial_user, $guest_name );
		  $message = "base price change: guest refund $guest_name\n";
		  add_financial_event( $financial_user, $billing, $refund_price, "credit",
				       $message, $mealid, "" );
		}
	      }
	    }
	  }
	
	  // change the price
	  $sql2 = "UPDATE webcal_meal SET cal_base_price = $price WHERE cal_id = $mealid";
	  dbi_query( $sql2 );

	  // recharge the previously signed-up diners
	  // members
	  $sql2 = "SELECT cal_login FROM webcal_meal_participant " . 
	    "WHERE cal_id = $mealid AND (cal_type = 'M' OR cal_type = 'T') ";
	  if ( $res2 = dbi_query( $sql2 ) ) {
	    while ( $row2 = dbi_fetch_row( $res2 ) ) {
	      $financial_user = $row2[0];
	      $billing = get_billing_group( $financial_user );
	      $charge_price = get_price( $mealid, $financial_user, false );
	      $description = "base price change: recharge";
	      add_financial_event( $financial_user, $billing, $charge_price, "charge",
				   $description, $mealid, "" );
	    }
	  }
	  // guests
	  $sql2 = "SELECT cal_host, cal_fullname FROM webcal_meal_guest " . 
	    "WHERE cal_meal_id = $mealid AND (cal_type = 'M' OR cal_type = 'T') ";
	  if ( $res2 = dbi_query( $sql2 ) ) {
	    while ( $row2 = dbi_fetch_row( $res2 ) ) {
	      $financial_user = $row2[0];
	      $guest_name = $row2[1];
	      $billing = get_billing_group( $financial_user );
	      $charge_price = get_guest_price( $mealid, $guest_name );
	      $message = "base price change: guest recharge $guest_name\n";
	      add_financial_event( $financial_user, $billing, $charge_price, "charge",
				   $message, $mealid, "" );
	    }
	  }
	}
      }
      
    } 
    else {

      /// find a new meal id
      $res = dbi_query ( "SELECT MAX(cal_id) FROM webcal_meal" );
      if ( $res ) {
	$row = dbi_fetch_row ( $res );
	$mealid = $row[0] + 1;
	dbi_free_result ( $res );
      } else {
	$mealid = 1;
      }


      $deadline = 2 + date( "w", $date );

      $sql2 = "INSERT INTO webcal_meal ( cal_id, cal_club_id, " .
	"cal_date, cal_time, cal_suit, cal_menu, " .
	"cal_base_price, cal_signup_deadline, cal_walkins, cal_notes, " .
	"cal_max_diners ) " .
	"VALUES ( ";
  
      $sql2 .= $mealid . ", ";	
      $sql2 .= "0, ";
      $sql2 .= date ( "Ymd", $date ) . ", ";
      $sql2 .= $time . ", ";
      $sql2 .= "'" . $suit . "', ";
      $sql2 .= "'" . $menu . "', ";
      $sql2 .= $price . ", ";
      $sql2 .= $deadline . ", ";
      $sql2 .= "'C',";
      $sql2 .= "'',";
      $sql2 .= "0" . ")";

      dbi_query( $sql2 );
    }
  }

  return $mealid;
}


function insert_crew( $mealid, $head_chef, $crew ) {
   
  // put in head chef if not already there
  if ( ($head_chef != "none") && (has_head_chef( $mealid ) == "") ) {
    edit_head_chef_participation( $mealid, 'A', $head_chef );
  }

  // put in crew if not already there
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $mealid AND cal_type = 'C'";
  if ( $res = dbi_query( $sql ) ) {
    if ( !($row = dbi_fetch_row( $res )) ) {
      $crew_array = explode( "&", $crew );

      $jobNum = 0;
      for ( $i=0; $i<count($crew_array); $i++ ) {
	if ( $crew_array[$i] == "" ) {
	  $i++;
	  continue;
	}
	$jobNum++;
	$placeholder = "none" . $jobNum;
	$job = $crew_array[$i++];
	$person = $crew_array[$i];
	$sql2 = "INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) " .
	  " VALUES ( " . $mealid . ", '" . $placeholder . "', 'C', '" . $job . "')";
	dbi_query( $sql2 );
	if ( $person != "none" ) 
	  edit_crew_participation( $mealid, 'A', $person, $job, $placeholder );
      }
    }
  }


}


function print_crew( $mealid, $date ) { 
  global $body;

  $body .= weekday_short_name( date( "w", $date ) ) . " - ";

  $head_chef = has_head_chef( $mealid );
  if ( $head_chef != "" ) {
    user_load_variables( $head_chef, "temp" );
    $body .= $GLOBALS[tempfirstname];
  } else {
    $body .= "*** OPEN. any takers? ***";
  }



  $body .= " - " . date_to_str( date( "Ymd", $date ), "__mon__ __dd__", false, true );



  $body .= " - menu: ";
  $menu = "";
  $sql = "SELECT cal_menu FROM webcal_meal WHERE cal_id = $mealid";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $menu = $row[0];
    }
    dbi_free_result( $res );
  } 
  if ( $menu == "" ) $body .= "??";
  else $body .= $menu;




  $body .= ", crew: ";
  $crew_openings = 0;
  $crew_number = 0;
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $mealid AND cal_type = 'C'";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $person = $row[0];
      if ( ereg( 'none.*', $person ) ) {
	$crew_openings++;
	$crew_number++;
      }
      else {
	user_load_variables( $person, "temp" );
	$body .= $GLOBALS[tempfirstname] . ", ";
	$crew_number++;
      }
    }
  }
  if ( $crew_openings > 0 ) $body .= $crew_openings . " crew opening(s)";
  $wday = date( "w", $date );
  if ( ($crew_number == 0) && ($wday == 6) && ($head_chef != "") ) $body .= "The Saturday Crew Team";
  $body .= "\n";

}

?>
