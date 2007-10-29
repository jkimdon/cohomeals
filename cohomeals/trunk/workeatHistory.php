<?php 

include_once 'includes/init.php';
include_once 'includes/munge_date.php';


$error = '';

print_header();


?>

<h2>Work/eat history</h2>

<form action="workeatHistory.php" method="get">

  <p></p>
  <table><tr>
  <td>View log from</td>
  <td><?php print_date_selection( "start", $startdate );?></td>
  </tr><tr>
  <td align=right>to</td>
  <td><?php print_date_selection( "end", $enddate );?></td>
  </tr></tr>
  <td></td><td align=center><input type="submit" value="Go" /></td>
  </tr></table>
</form>



<?php
display_workeat_log( $startdate, $enddate );
?>


<?php
print_trailer ();
?>
</body>
</html>
