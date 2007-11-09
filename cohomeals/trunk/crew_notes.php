<?php
include_once 'includes/init.php';

$error = '';

?><form action="crew_notes_handler.php" method="post"><?php

$id = mysql_safe( getGetValue( 'id' ), false );
$user = mysql_safe( getGetValue( 'user' ), true );
$notes = trim( mysql_safe( getGetValue( 'notes' ), true ) );
if ( !isset( $user ) ) $user = $login;

if ( is_signer( $user ) == true ) {

  ?>

  <h4>Crew notes</h4>
  <input type="text" name="notes" id="notes" size="25" value="<?php echo htmlspecialchars( $notes );?>" maxlength="80"/>

  <br>
  <input type="submit" value="Save" />
  <?php

} else {
  $error = "Not authorized";
}

echo "<input type=\"hidden\" name=\"user\" value=\"$user\" />";
echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />";

?>

</form>

</body>
</html>
