<?php
/*
 * Description:
 * Subscribe user to all club meals for a given club
 *
 */
include_once 'includes/init.php';

$INC = array('js/popups.php');
$BodyX = '';
print_header ( $INC, '', $BodyX );
?>

<h2>Select club:</h2>

<?php
$row_num = 1;


$sql = "SELECT cal_id, cal_club_id, cal_date, cal_time, cal_notes " .
       "FROM webcal_meal " .
       "WHERE cal_suit = 'club' " .
       "ORDER BY cal_club_id";
$res = dbi_query ( $sql );
$weekdays = array ();
$dates = array ();
if ( $res ) {
  $prev_club = 0;
  $first = true;
  while ( $row = dbi_fetch_row ( $res ) ) {
    $club_id = $row[1];
    $date = $row[2];
    if ( $club_id != $prev_club ) {
      $i=0;
      if ( $first == false ) {
	print_one_club ( $prev_club, $time, $notes, $weekdays, $dates, $row_num );
	$row_num = ( $row_num == 1 ) ? 0:1;
      }
      $time = $row[3];
      $notes = $row[4];
      $dates[0] = date_to_str ( $date, "", false );
      $first = false;
    }
    else {
      $dates[1] = date_to_str ( $date, "", false );
    }

    $year = substr ( $date, 0, 4 );
    $month = substr ( $date, 4, 2 );
    $day = substr ( $date, 6, 2 );
    $weekdays[$i] = date ( "w", mktime ( 3, 0, 0, $month, $day, $year ) );
    $i++;

    $prev_club = $club_id;
  }
  dbi_free_result ( $res );

  print_one_club ( $club_id, $time, $notes, $weekdays, $dates, $row_num );
  
}
else {
  echo "No club meals found.<br \>";
}
?>

<?php print_trailer(); ?>
</body>
</html>



<?php
function print_one_club ( $club_id, $time, $notes, $weekdays, $dates, $row_num ) {
  global $login;


  $sql = "SELECT cal_login FROM webcal_subscriptions " .
    "WHERE cal_login = '$login' " .
    "AND cal_suit = 'club' AND cal_club_id = " . $club_id;
  $res = dbi_query ( $sql );
  if ( $res ) {
    if ( dbi_fetch_row ( $res ) )
      $already_eating = true;
    else
      $already_eating = false;
  }

  ?>

  <table>
  <tr class="d<?php echo $row_num;?>"><td>
  <?php if ( $already_eating == false ) {?>
    <a name="participation" class="addbutton" <?php echo "href=\"subscribe_club_handler.php?club_id=$club_id&action=A\"";?>>Subscribe me</a></td>
  <?php } else { ?>
    <a name="participation" class="addbutton" <?php echo "href=\"subscribe_club_handler.php?club_id=$club_id&action=D\"";?>>Unsubscribe me</a></td>
  <?php } ?>

  </td><td style="font-weight:bold">Club info:</td><td></td></tr>

  <?php echo "<tr class=\"d$row_num\">";?>
  <td><a href class="addbutton" onclick="window.open('<?php echo "signup_buddy.php?id=$club_id&type=B&action=A";?>', 'Subscribe buddies', 'width=150,height=300,resizable=yes,scrollbars=yes');">Subscribe buddy</a></td>
  <td>time:</td>
  <?php echo "<td>" . display_time ( $time ) . "</td></tr>";
  echo "<tr class=\"d$row_num\">"; ?>
  <td><a href class="addbutton" onclick="window.open('<?php echo "signup_buddy.php?id=$club_id&type=B&action=D";?>', 'Unsubscribe buddies', 'width=150,height=300,resizable=yes,scrollbars=yes');">Unsubscribe buddy</a></td>
  <td>meal notes:</td>
  <?php echo "<td>" . $notes . "</td></tr>";
  echo "<tr class=\"d$row_num\"><td></td><td>dates:</td><td>" . $dates[0] . " to " . $dates[1] . "</td></tr>";
  echo "<tr class=\"d$row_num\"><td></td><td>day(s) of the week:</td><td>";
  for ( $i = 0; $i < 7; $i++ ) {
    $counted[$i] = false;
  }

  for ( $i = 0; $i < count ( $weekdays ); $i++ ) {
    $val = $weekdays[$i];
    if ( $counted[ $val ] == false ) {
      echo weekday_name ( $val ) . "s ";
      $counted[ $val ] = true;
    }
  }
  echo "</td></tr></table>";
}


?>
