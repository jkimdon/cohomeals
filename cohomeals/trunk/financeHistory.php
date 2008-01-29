<?php
include_once 'includes/init.php';
include_once 'includes/munge_date.php';

$bymeal = getValue( 'sortbymeal' );
if ( $bymeal == 1 ) $sortbymeal = true;
else $sortbymeal = false;
$error = '';

print_header();


?>

<h2>Financial history</h2>

<form action="financeHistory.php" method="get">

  <p></p>
  <table><tr>
  <td>View history from</td>
  <td><?php print_date_selection( "start", $startdate );?></td>
  </tr><tr>
  <td align=right>to</td>
  <td><?php print_date_selection( "end", $enddate );?></td>
  </tr><tr>
  <td><input type="radio" name="sortbymeal" value="0" <?php if ( $sortbymeal == false ) echo " checked=\"checked\"";?> />Sort by transaction date</td>
  </tr><tr>
  <td><input type="radio" name="sortbymeal" value="1" <?php if ( $sortbymeal == true ) echo " checked=\"checked\"";?> />Sort by meal date</td>
  </tr><tr>
  <td></td><td align=center><input type="submit" value="Go" /></td>
  </tr></table>
</form>



<?php
$logs = collect_financial_log( $billing_group, $startdate, $enddate, $sortbymeal );
display_financial_log( $billing_group, $sortbymeal, $logs );
?>


<?php
print_trailer ();
?>
</body>
</html>
