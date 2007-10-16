<?php
/* $Id: edit_user.php,v 1.41 2005/02/26 06:49:45 cknudsen Exp $ */
include_once 'includes/init.php';

$user = getGetValue( 'user' );

if ( ! $is_meal_coordinator )
  $user = $login;

// cannot edit public user.
if ( $user == '__public__' )
  $user = $login;

// don't allow them to create new users if it's not allowed
if ( empty ( $user ) ) {
  // asking to create a new user
  if ( ! $is_meal_coordinator ) {
    // must be meal_coordinator...
    do_redirect ( "month.php" );
    exit;
  }
}

print_header ( '', '', '', true );
?>
<table style="border-width:0px;">
<tr><td style="vertical-align:top; width:50%;">
<h2><?php
  if ( ! empty ( $user ) ) {
    user_load_variables ( $user, "u" );
    $ufirstname = $GLOBALS['ufirstname'];
    $ulastname = $GLOBALS['ulastname'];
    $ubirthdate = $GLOBALS['ubirthdate'];
    $uemail = $GLOBALS['uemail'];
    $ubilling_group = $GLOBALS['ubilling_group'];
    $uis_meal_coordinator = $GLOBALS['uis_meal_coordinator'];
    $uis_beancounter = $GLOBALS['uis_beancounter'];
    echo "User info";
  } else {
    echo "Add User";
  }
?></h2>
<form action="edit_user_handler.php" method="post">
<input type="hidden" name="formtype" value="edituser" />
<?php
	if ( empty ( $user ) ) {
		echo "<input type=\"hidden\" name=\"add\" value=\"1\" />\n";
	}
?>

<table style="border-width:0px;">
<tr>
  <td><label for="username">Username:</label></td>
  <td>
  <?php
    if ( ! empty ( $user ) ) {
      if ( $is_meal_coordinator )
        echo $user . "<input name=\"user\" type=\"hidden\" value=\"" .
          htmlspecialchars ( $user ) . "\" />\n";
      else
        echo $user;
    } else {
      echo "<input type=\"text\" name=\"user\" id=\"username\" size=\"25\" maxlength=\"25\" />\n";
    }
?>
  </td>
</tr>
<tr>
  <td><label for="ufirstname">First Name:</label></td>
  <?php if ( $is_meal_coordinator ) {?>
    <td><input type="text" name="ufirstname" id="ufirstname" size="20" value="<?php echo empty ( $ufirstname ) ? '' : htmlspecialchars ( $ufirstname );?>" /></td>
  <?php } else {
    echo "<td>$ufirstname</td>";
  } ?>
</tr>
<tr>
  <td><label for="ulastname">Last Name:</label></td>
  <?php if ( $is_meal_coordinator ) {?>
    <td><input type="text" name="ulastname" id="ulastname" size="20" value="<?php echo empty ( $ulastname ) ? '' : htmlspecialchars ( $ulastname );?>" /></td>
  <?php } else {
    echo "<td>$ulastname</td>";
  } ?> 
</tr>
<tr>
  <td><label for="ubirthdate">Birthdate:</label></td>
  <?php if ( $is_meal_coordinator ) {?>
    <td><?php print_birthdate_selection( $ubirthdate ); ?></td>
  <?php } else {
    echo "<td>" . substr( $ubirthdate, 6, 2 ) .
      " " . month_short_name ( substr ( $ubirthdate, 4, 2 ) - 1 ) . 
      " " . substr ( $ubirthdate, 0, 4 ) . "</td>";
  } ?>
</tr>
<tr>
  <td><label for="uemail">E-mail address:</label></td>
  <?php if ( $is_meal_coordinator ) {?>
    <td><input type="text" name="uemail" id="uemail" size="20" value="<?php echo empty ( $uemail ) ? '' : htmlspecialchars ( $uemail );?>" /></td>
  <?php } else {
    echo "<td>$uemail</td>";
  } ?>
</tr>
<tr>
  <td><label for="ubilling_group">Billing group:</label></td>
  <?php if ( $is_meal_coordinator ) {?>
    <td><input type="text" name="ubilling_group" id="ubilling_group" size="20" value="<?php echo empty ( $ubilling_group ) ? '' : htmlspecialchars ( $ubilling_group );?>" /></td>
  <?php } else {
    echo "<td>$ubilling_group</td>";
  } ?>
</tr>


<?php if ( empty ( $user ) && ! $use_http_auth && $user_can_update_password ) { ?>
	<tr><td>
		<label for="pass1"><?php etranslate("Password")?>:</label></td><td>
		<input name="upassword1" id="pass1" size="15" value="" type="password" />
	</td></tr>
	<tr><td>
		<label for="pass2"><?php etranslate("Password")?> (<?php etranslate("again")?>):</label></td><td>
		<input name="upassword2" id="pass2" size="15" value="" type="password" />
	</td></tr>
<?php }
if ( $is_meal_coordinator ) { ?>
 <tr><td style="font-weight:bold;">Meal coordinator:</td>
    <td><label><input type="radio" name="uis_meal_coordinator" value="Y"<?php if ( ! empty ( $uis_meal_coordinator ) && $uis_meal_coordinator == "Y" ) echo " checked=\"checked\"";?> />&nbsp;<?php etranslate("Yes")?></label> 
		<label><input type="radio" name="uis_meal_coordinator" value="N"<?php if ( empty ( $uis_meal_coordinator ) || $uis_meal_coordinator != "Y" ) echo " checked=\"checked\"";?> />&nbsp;<?php etranslate("No")?></label>
	</td></tr>

	<tr><td style="font-weight:bold;">Bookkeeper:</td><td>
		<label><input type="radio" name="uis_beancounter" value="Y"<?php if ( ! empty ( $uis_beancounter ) && $uis_beancounter == "Y" ) echo " checked=\"checked\"";?> />&nbsp;<?php etranslate("Yes")?></label> 
		<label><input type="radio" name="uis_beancounter" value="N"<?php if ( empty ( $uis_beancounter ) || $uis_beancounter != "Y" ) echo " checked=\"checked\"";?> />&nbsp;<?php etranslate("No")?></label>
	</td></tr>
<?php } //end if ($is_meal_coordinator ) ?>
	<tr><td colspan="2">
	<?php if ( $is_meal_coordinator ) { ?>
          <input type="submit" value="Save" />
        <?php } ?>
	<?php if ( $is_meal_coordinator && ! empty ( $user ) ) { ?>
	  <input type="submit" name="action" value="Delete" onclick="return confirm('Are you sure you want to delete this user?')" />
	<?php } ?>
	</td></tr>
</table>
</form>

<?php if ( ! empty ( $user ) && ! $use_http_auth &&
  ( isset ( $user_can_update_password ) && $user_can_update_password ) ) { ?>
</td><td>&nbsp;&nbsp;</td>
<td style="vertical-align:top;">

<h2><?php etranslate("Change Password")?></h2>
<form action="edit_user_handler.php" method="post">
<input type="hidden" name="formtype" value="setpassword" />
<?php if ( $is_meal_coordinator ) { ?>
	<input type="hidden" name="user" value="<?php echo $user;?>" />
<?php } ?>
<table style="border-width:0px;">
	<tr><td>
		<label for="newpass1"><?php etranslate("New Password")?>:</label></td><td>
		<input name="upassword1" id="newpass1" type="password" size="15" />
	</td></tr>
	<tr><td>
		<label for="newpass2"><?php etranslate("New Password")?> (<?php etranslate("again")?>):</label></td><td>
		<input name="upassword2" id="newpass2" type="password" size="15" />
	</td></tr>
	<tr>
	<td colspan="2"><input type="submit" value="Set Password" /></td>
        </tr>
</table>
</form>
<?php } ?>
</td></tr></table>

<?php print_trailer ( false, true, true ); ?>
</body>
</html>
