<?php
include_once 'includes/init.php';

$INC = array();
print_header($INC,'','',true);
?>

<form action="block_diner_handler.php" method="post">

<h2>The following buddies are subscribed to this meal and have not yet been signed up to eat. Check the names of those who do not wish to be automatically signed up to eat, then click submit at the bottom of the page.</h2>

<?php
$id = getGetValue( 'id' );

$signees = get_signees( $login, true );
$count = 0;			   
echo "<table><tr></tr>";
   
for ( $i=0; $i<count( $signees ); $i++ ) {
  $user = $signees[$i]['cal_login'];
  $subscribed = is_subscriber( $id, $user );
  $already_blocked = is_blocked( $id, $user );
  $already_dining = is_dining( $id, $user );
  if ( $subscribed && !$already_blocked && !$already_dining ) {
    echo "<tr>\n";
    echo "<td><label>" .
      "<input type=\"checkbox\" name=\"" . $user . 
      "\"\></td>";
    echo "<td>" . $signees[$i]['cal_fullname'] . "</td>";
    echo "</tr>\n";
    $count++;
  }
}
echo "</table>";

if ( $count == 0 )
  echo "None of your buddies qualify.\n";
?>


<input type="hidden" name="id" value="<?php echo $id;?>" />

<p align="center"><input type="submit" value="Submit"/></p>
</form>

<?php print_trailer ( false, true, true ); ?>
</body>
</html>
