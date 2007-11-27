<?php
include_once 'includes/init.php';

$INC = array();
print_header($INC,'','',true);
?>

<form action="signup_guest_handler.php" method="post">

<?php
$action = getGetValue( 'action' );
$type = getGetValue( 'type' );
$id = getGetValue( 'id' );
?>

<h4>Sign up guest</h4><br>
Recall the guest will be charged to your account.

<p>
Enter the full name of your guest:
<input type="text" name="guest_name" size = "25" maxlength="48", value=""/>
</p>

<p>
Enter their cost class:
<select name="age">
<option value="A" selected="selected">Adult</option>
<option value="C">Age 4-12</option>
<option value="F">Age 0-3</option>
</select>
</p>

<input type="hidden" name="id" value="<?php echo $id;?>" />
<input type="hidden" name="action" value="<?php echo $action;?>" />
<input type="hidden" name="type" value="<?php echo $type;?>" />
<input type="hidden" name="miniwindow" value="<?php echo true;?>" />

<p align="center"><input type="submit" value="Submit"/></p>
</form>

<?php print_trailer ( false, true, true ); ?>
</body>
</html>