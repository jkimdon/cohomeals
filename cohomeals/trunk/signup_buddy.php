<?php
include_once 'includes/init.php';

$INC = array();
print_header($INC,'','',true);
?>

<form action="signup_buddy_handler.php" method="post">

<?php
$action = getGetValue( 'action' );
$type = getGetValue( 'type' );
$id = getGetValue( 'id' );

$choose_pre_or_walkin = false;
if ( $is_meal_coordinator && ($type == "M" || $type == "T") ) 
  $choose_pre_or_walkin = true;

$signees = get_signees( $login, true );
$count = 0;			   
if ( $choose_pre_or_walkin ) {
  echo "W = walkin, P = pre-signup<br>";
  echo "<hr>";
  echo "<table>";
  echo "<tr class=\"d1\"><td>W</td><td>P</td><td>Name</td></tr>";
}
else
  echo "<table><tr></tr>";
   
for ( $i=0; $i<count( $signees ); $i++ ) {
  $user = $signees[$i]['cal_login'];
  $partic = is_participating( $id, $user, $type );
  if ( ( !$partic && ($action == 'A')) ||
       ( $partic && ($action == 'D') ) ) {
    echo "<tr>\n";
    if ( $choose_pre_or_walkin ) {
      echo "<td><label>" .
	"<input type=\"radio\" name=\"" . $user . 
	"\" value = \"walkin\" \></td>\n";
      echo "<td><label>" .
	"<input type=\"radio\" name=\"" . $user . 
	"\" value = \"pre\" \></td>\n";
    } else {
      echo "<td><label>" .
	"<input type=\"checkbox\" name=\"" . $user . 
	"\"\></td>";
    }
    echo "<td>" . $signees[$i]['cal_fullname'] . "</td>";
    echo "</tr>\n";
    $count++;
  }
}
echo "</table>";

if ( $count == 0 )
  echo "No one has given you permission to sign them up for meals or else all of your buddies are already signed up.\n";
?>


<input type="hidden" name="id" value="<?php echo $id;?>" />
<input type="hidden" name="action" value="<?php echo $action;?>" />
<input type="hidden" name="type" value="<?php echo $type;?>" />

<p align="center"><input type="submit" value="Submit"/></p>
</form>

<?php print_trailer ( false, true, true ); ?>
</body>
</html>
