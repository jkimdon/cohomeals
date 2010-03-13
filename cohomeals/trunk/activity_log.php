<?php
// fixme: not security checked
include_once 'includes/init.php';
include_once 'includes/site_extras.php';
$PAGE_SIZE = 25;
print_header();

echo "<h3>Activity Log</h3>\n";

echo "<a title=\"Admin\" class=\"nav\" href=\"adminhome.php\">&laquo;&nbsp;Admin</a><br /><br />\n";

echo "<table>\n";
echo "<tr><th class=\"usr\">\n" .
  "User</th><th class=\"cal\">\n" .
  "Calendar</th><th class=\"scheduled\">\n" .
  "Date/Time</th><th class=\"dsc\">\n" .
  "Event</th><th class=\"action\">\n" .
  "Action\n</th></tr>\n";
$sql = "SELECT webcal_entry_log.cal_login, webcal_entry_log.cal_user_cal, " .
  "webcal_entry_log.cal_type, webcal_entry_log.cal_date, " .
  "webcal_entry_log.cal_time, webcal_meal.cal_id, " .
  "webcal_meal.cal_suit, webcal_entry_log.cal_log_id " .
  "FROM webcal_entry_log, webcal_meal " .
  "WHERE webcal_entry_log.cal_entry_id = webcal_meal.cal_id ";
$startid = getIntValue ( 'startid', true );
if ( ! empty ( $startid ) )
  $sql .= "AND webcal_entry_log.cal_log_id <= $startid ";
$sql .= "ORDER BY webcal_entry_log.cal_log_id DESC";
$res = dbi_query ( $sql );

$nextpage = "";

if ( $res ) {
  $num = 0;
  while ( $row = dbi_fetch_row ( $res ) ) {
    $num++;
    if ( $num > $PAGE_SIZE ) {
      $nextpage = $row[7];
      break;
    } else {
	echo "<tr";
		if ( $num % 2 ) {
			echo " class=\"odd\"";
		}
	echo "><td>\n" .
        $row[0] . "</td><td>\n" .
        $row[1] . "</td><td>\n" . 
        date_to_str ( $row[3] ) . "&nbsp;" .
        display_time ( $row[4] ) . "</td><td>\n" . 
        "<a title=\"" .
        htmlspecialchars($row[6]) . "\" href=\"view_entry.php?id=$row[5]\">" .
        htmlspecialchars($row[6]) . "</a></td><td>\n";
      if ( $row[2] == $LOG_CREATE )
        echo "Event created";
      else if ( $row[2] == $LOG_APPROVE )
        echo "Event approved";
      else if ( $row[2] == $LOG_REJECT )
        echo "Event rejected";
      else if ( $row[2] == $LOG_UPDATE )
        echo "Event updated";
      else if ( $row[2] == $LOG_DELETE )
        echo "Event deleted";
      else if ( $row[2] == $LOG_NOTIFICATION )
        echo "Notification sent";
      else if ( $row[2] == $LOG_REMINDER )
        echo "Reminder sent";
      else
        echo "???";
      echo "\n</td></tr>\n";
    }
  }
  dbi_free_result ( $res );
} else {
  echo "Database error: " . dbi_error ();
}
?>
</table><br />
<div class="navigation">
<?php
//go BACK in time
if ( ! empty ( $nextpage ) ) {
  echo "<a title=\"" . 
  	"Previous &nbsp;$PAGE_SIZE&nbsp;" . 
	"Events\" class=\"prev\" href=\"activity_log.php?startid=$nextpage\">" . 
  	"Previous &nbsp;$PAGE_SIZE&nbsp;" . 
	"Events</a>\n";
}

if ( ! empty ( $startid ) ) {
  $previd = $startid + $PAGE_SIZE;
  $res = dbi_query ( "SELECT MAX(cal_log_id) FROM " .
    "webcal_entry_log" );
  if ( $res ) {
    if ( $row = dbi_fetch_row ( $res ) ) {
      if ( $row[0] <= $previd ) {
        $prevarg = '';
      } else {
        $prevarg = "?startid=$previd";
      }
      //go FORWARD in time
      echo "<a title=\"" . 
  	"Next &nbsp;$PAGE_SIZE&nbsp;" . 
	"Events\" class=\"next\" href=\"activity_log.php$prevarg\">" . 
  	"Next &nbsp;$PAGE_SIZE&nbsp;" . 
	"Events</a><br />\n";
    }
    dbi_free_result ( $res );
  }
}
?>
</div>
<?php print_trailer(); ?>
</body>
</html>
