<?php
include_once 'includes/init.php';



if ( $is_meal_coordinator || $is_beancounter ) {


  //////////////////////
  // make changes to existing foods
  
  $sql = "SELECT cal_food_id FROM webcal_pantry_food";
  $res = dbi_query( $sql );
  while( $row = dbi_fetch_row( $res ) ) {
    $id = $row[0];

    $change = "";
    $key = "changeCat$id";
    $change = mysql_safe( getValue( $key ), true );
    if ( $change != "" ) {
      $sql2 = "UPDATE webcal_pantry_food SET cal_category = '$change' WHERE cal_food_id = $id";
      dbi_query( $sql2 );
    }

    $change = "";
    $key = "changeDollar$id";
    $change = mysql_safe( getValue( $key ), true );
    if ( $change != "" ) {
      $key2 = "changeCents$id";
      $cents = mysql_safe( getValue( $key2 ), true );      
      $new_price = 100*$change + $cents;

      $sql2 = "UPDATE webcal_pantry_food SET cal_unit_price = $new_price WHERE cal_food_id = $id";
      dbi_query( $sql2 );
    }

    $change = "";
    $key = "changeFlags$id";
    $change = mysql_safe( getValue( $key ), true );
    if ( $change != "" ) {
      $sql2 = "UPDATE webcal_pantry_food SET cal_flags = '$change' WHERE cal_food_id = $id";
      dbi_query( $sql2 );
    }


    $change = "";
    $key = "toggleAvail$id";
    $change = mysql_safe( getValue( $key ), true );
    if ( $change == true ) {
      $sql3 = "SELECT cal_available_meals FROM webcal_pantry_food WHERE cal_food_id = $id";
      $res3 = dbi_query( $sql3 );
      $row3 = dbi_fetch_row( $res3 );
      $new = ( $row3[0] == 1 ) ? 0:1;
      
      $sql2 = "UPDATE webcal_pantry_food SET cal_available_meals = $new WHERE cal_food_id = $id";
      dbi_query( $sql2 );
    }

    $change = "";
    $key = "toggleIndiv$id";
    $change = mysql_safe( getValue( $key ), true );
    if ( $change == true ) {
      $sql3 = "SELECT cal_available_individuals FROM webcal_pantry_food WHERE cal_food_id = $id";
      $res3 = dbi_query( $sql3 );
      $row3 = dbi_fetch_row( $res3 );
      $new = ( $row3[0] == 1 ) ? 0:1;
      
      $sql2 = "UPDATE webcal_pantry_food SET cal_available_individuals = $new WHERE cal_food_id = $id";
      dbi_query( $sql2 );
    }

    $change = "";
    $key = "changeNotes$id";
    $change = mysql_safe( getValue( $key ), true );
    if ( $change != "" ) {
      $sql2 = "UPDATE webcal_pantry_food SET cal_notes = '$change' WHERE cal_food_id = $id";
      dbi_query( $sql2 );
    }


  }



  ///////////////////////
  /// add in new foods

  $newcat1 = "Misc";
  $newcat1 = mysql_safe( getValue( 'newcat1' ), true );
  $newdescr1 = "";
  $newdescr1 = mysql_safe( getValue( 'newdescr1' ), true );
  $newunit1 = mysql_safe( getValue( 'newunit1' ), true );
  $newdollars1 = mysql_safe( getValue( 'newdollars1' ), true );
  $newcents1 = mysql_safe( getValue( 'newcents1' ), true );
  $newflags1 = mysql_safe( getValue( 'newflags1' ), true );
  $newavail1 = mysql_safe( getValue( 'newavail1' ), true );
  $newindiv1 = mysql_safe( getValue( 'newindiv1' ), true );
  $newnotes1 = mysql_safe( getValue( 'newnotes1' ), true );

  $newcat2 = "Misc";
  $newcat2 = mysql_safe( getValue( 'newcat2' ), true );
  $newdescr2 = "";
  $newdescr2 = mysql_safe( getValue( 'newdescr2' ), true );
  $newunit2 = mysql_safe( getValue( 'newunit2' ), true );
  $newdollars2 = mysql_safe( getValue( 'newdollars2' ), true );
  $newcents2 = mysql_safe( getValue( 'newcents2' ), true );
  $newflags2 = mysql_safe( getValue( 'newflags2' ), true );
  $newavail2 = mysql_safe( getValue( 'newavail2' ), true );
  $newindiv2 = mysql_safe( getValue( 'newindiv2' ), true );
  $newnotes2 = mysql_safe( getValue( 'newnotes2' ), true );

  $newcat3 = "Misc";
  $newcat3 = mysql_safe( getValue( 'newcat3' ), true );
  $newdescr3 = "";
  $newdescr3 = mysql_safe( getValue( 'newdescr3' ), true );
  $newunit3 = mysql_safe( getValue( 'newunit3' ), true );
  $newdollars3 = mysql_safe( getValue( 'newdollars3' ), true );
  $newcents3 = mysql_safe( getValue( 'newcents3' ), true );
  $newflags3 = mysql_safe( getValue( 'newflags3' ), true );
  $newavail3 = mysql_safe( getValue( 'newavail3' ), true );
  $newindiv3 = mysql_safe( getValue( 'newindiv3' ), true );
  $newnotes3 = mysql_safe( getValue( 'newnotes3' ), true );

  if ( $newdescr1 != "" ) {
    $res = dbi_query( "SELECT MAX(cal_food_id) FROM webcal_pantry_food" );
    $row = dbi_fetch_row( $res );
    $id = $row[0] + 1;
    $price = 100*$newdollars1 + $newcents1;
    if ( $newavail1 == "y" ) $avail = 1;
    else $avail = 0;
    if ( $newindiv1 == "y" ) $indiv = 1;
    else $indiv = 0;

    $sql = "INSERT INTO webcal_pantry_food " .
      "( cal_food_id, cal_description, cal_category, cal_unit, cal_unit_price, cal_available_meals, cal_available_individuals, cal_flags, cal_notes ) " .
      " VALUES ( $id, '$newdescr1', '$newcat1', '$newunit1', $price, $avail, $indiv, '$newflags1', '$newnotes1' )";
    dbi_query( $sql );
  }


  if ( $newdescr2 != "" ) {
    $res = dbi_query( "SELECT MAX(cal_food_id) FROM webcal_pantry_food" );
    $row = dbi_fetch_row( $res );
    $id = $row[0] + 1;
    $price = 100*$newdollars2 + $newcents2;
    if ( $newavail2 == "y" ) $avail = 1;
    else $avail = 0;
    if ( $newindiv2 == "y" ) $indiv = 1;
    else $indiv = 0;

    $sql = "INSERT INTO webcal_pantry_food " .
      "( cal_food_id, cal_description, cal_category, cal_unit, cal_unit_price, cal_available_meals, cal_available_individuals, cal_flags, cal_notes ) " .
      " VALUES ( $id, '$newdescr2', '$newcat2', '$newunit2', $price, $avail, $indiv, '$newflags2', '$newnotes2' )";
    dbi_query( $sql );
  }


  if ( $newdescr3 != "" ) {
    $res = dbi_query( "SELECT MAX(cal_food_id) FROM webcal_pantry_food" );
    $row = dbi_fetch_row( $res );
    $id = $row[0] + 1;
    $price = 100*$newdollars3 + $newcents3;
    if ( $newavail3 == "y" ) $avail = 1;
    else $avail = 0;
    if ( $newindiv3 == "y" ) $indiv = 1;
    else $indiv = 0;

    $sql = "INSERT INTO webcal_pantry_food " .
      "( cal_food_id, cal_description, cal_category, cal_unit, cal_unit_price, cal_available_meals, cal_available_individuals, cal_flags, cal_notes ) " .
      " VALUES ( $id, '$newdescr3', '$newcat3', '$newunit3', $price, $avail, $indiv, '$newflags3', '$newnotes3' )";
    dbi_query( $sql );
  }


 $nexturl = "pantry_management.php";
 do_redirect( $nexturl );

 } else {
  echo "Not authorized<br>";
 }



print_header();

print_trailer();
?>
</body>
</html>
