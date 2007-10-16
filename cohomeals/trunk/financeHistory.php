<?php
include_once 'includes/init.php';
include_once 'includes/munge_date.php';


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
  </tr></tr>
  <td></td><td align=center><input type="submit" value="Go" /></td>
  </tr></table>
</form>



<?php
display_financial_log( $billing_group, $startdate, $enddate );
?>


<?php
print_trailer ();
?>
</body>
</html>
