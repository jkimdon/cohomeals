<?php
include_once 'includes/init.php';
include_once 'includes/munge_date.php';

$bymeal = getValue( 'sortbymeal' );
if ( $bymeal == 1 ) $sortbymeal = true;
else $sortbymeal = false;

$creditsonly = false;
$creditsonly = getValue( 'creditsonly' );


$error = '';

$INC = array( 'js/functions.php' );
$BodyX = '';
print_header( $INC, '', $BodyX );

?>

<h2>Financial history</h2>

<form action="financeHistory.php" method="get" name="financehistoryform">

  <p></p>
  <table><tr>
  <td>View history from</td>
  <td><?php print_date_selection( "start", $startdate, "financehistoryform" );?></td>
  </tr><tr>
  <td align=right>to</td>
  <td><?php print_date_selection( "end", $enddate, "financehistoryform" );?></td>
  </tr><tr>
  <td><input type="radio" name="sortbymeal" value="0" <?php if ( $sortbymeal == false ) echo " checked=\"checked\"";?> />Sort by transaction date</td>
  </tr><tr>
  <td><input type="radio" name="sortbymeal" value="1" <?php if ( $sortbymeal == true ) echo " checked=\"checked\"";?> />Sort by meal date</td>
  </tr><tr>
   <td><input type="checkbox" name="creditsonly" <?php if ( $creditsonly == true ) echo " checked=\"checked\"";?> />Credits only</td>
   </tr></tr>
  <td></td><td align=center><input type="submit" value="Go" /></td>
  </tr></table>
</form>



<?php
   $logs = collect_financial_log( $billing_group, $startdate, $enddate, $sortbymeal, $creditsonly );
display_financial_log( $billing_group, $sortbymeal, $logs );
?>


<?php
print_trailer ();
?>
</body>
</html>
