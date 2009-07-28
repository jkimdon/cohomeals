<?php
include_once 'includes/init.php';

$id = mysql_safe( getValue( 'meal_id' ), false );

if ( paperwork_done( $id ) ) {
  $nexturl = "display_meal_summary.php?id=$id";
  do_redirect( $nexturl );
} else {


if ( $is_meal_coordinator || $is_beancounter || is_chef( $id, $login ) ) {

  //// edit goes back to meal_summary; submit goes to handler
  $what_to_do = getValue( 'editorsubmit' );
  if ( $what_to_do == "Edit" ) {
    echo "<form action=\"meal_summary.php\" name=\"chooseform\" method=\"post\">";
  } else if ( $what_to_do == "Submit" ) {
    echo "<form action=\"meal_summary_handler.php\" name=\"chooseform\" method=\"post\">";
  } else echo "error<br>";



  ///// pass through the variables

  ?><input type="hidden" name="meal_id" value="<?php echo $id;?>"/><?php

  $names = user_get_users();
  foreach ( $names as $name ) {
    $username = $name['cal_login'];
    $value = getValue( $username );
    echo "<input type=\"hidden\" name=\"$username\" value=\"$value\"/>";
  }

  for ( $i=0; $i<7; $i++ ) {
    $key = "newguest$i";
    if ( $guest_name = getValue( $key ) ) {
      $key = "host$i";
      $host = getValue( $key );
      $key = "fee$i";
      $fee_class = getValue( $key );
      echo "<input type=\"hidden\" name=\"newguest$i\" value=\"$guest_name\"/>";
      echo "<input type=\"hidden\" name=\"host$i\" value=\"$host\"/>";
      echo "<input type=\"hidden\" name=\"fee$i\" value=\"$fee_class\"/>";
    }
  }


  for ( $i=0; $i<4; $i++ ) {
    $key = "shopper$i";
    $shopper = getValue( $key );
    if ( $shopper != 'none' ) {
      $key = "vendor$i";
      $vendor = getValue( $key );
	
      $key = "dollars$i";
      $dollars = getValue( $key );
	
      $key = "cents$i";
      $cents = getValue( $key );

      $amount = 100*$dollars + $cents;
      $expenses += $amount;
      $expenses_shoppers += $amount;

      echo "<input type=\"hidden\" name=\"shopper$i\" value=\"$shopper\"/>";      
      echo "<input type=\"hidden\" name=\"vendor$i\" value=\"$vendor\"/>";
      echo "<input type=\"hidden\" name=\"dollars$i\" value=\"$dollars\"/>";
      echo "<input type=\"hidden\" name=\"cents$i\" value=\"$cents\"/>";
    }
  }

  $expenses_farmer = getValue( "farmersmarket" );
  echo "<input type=\"hidden\" name=\"farmersmarket\" value=\"$expenses_farmer\"/>";	

  $flatrate = getValue( 'flatrate' );
  echo "<input type=\"hidden\" name=\"flatrate\" value=\"$flatrate\"/>";


  /// pantry items

  $pantry_description = "";
  $expenses_pantry = 0;
  $sql = "SELECT cal_food_id " . 
	 "FROM webcal_pantry_food WHERE cal_available_meals = 1";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $food_id = $row[0];

      $key = "amount$food_id";
      $amount = getValue( $key );

      if ( $amount != 0 ) {
	echo "<input type=\"hidden\" name=\"amount$food_id\" value=\"$amount\"/>";
      }
    }
  }
 

 ?></form>

 <?php

 } else {
  echo "Not authorized<br>";
 }

}

print_header();

print_trailer();
?>
</body>
</html>

<script type="text/javascript">
document.chooseform.submit();
</script>  
