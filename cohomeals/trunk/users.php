<?php
/*
	NOTE:
	There are THREE components that make up the functionality of users.php.
	1. users.php
		- contains the tabs
		- lists users
		- has an iframe for adding/editing users
	2. edit_user.php
		- the contents of the iframe (i.e. a form for adding/editing users)
	3. edit_user_handler.php
		- handles form submittal from edit_user.php
		- provides user with confirmation of successful operation
		- refreshes the parent frame (users.php)

*/

/* $Id $ */

include_once 'includes/init.php';

if ( empty ( $login) || $login == "__public__" ) {
  // do not allow public access
  do_redirect ( "month.php" );
  exit;
}

$INC = array('js/users.php','js/visible.php');
print_header( $INC );

?>
<br />

<!-- TABS -->
<div id="tabs">

  <span class="tabfor" id="tab_users"><a href="#tabusers" onclick="return showTab('users')">
  <?php if ($is_admin) {
    echo "Users";
  } else {
    echo "Account";
  }?>
  </a></span>

  <span class="tabbak" id="tab_buddies"><a href="#tabbuddies" onclick="return showTab('buddies')">Buddies</a></span>

</div>


<!-- TABS BODY -->

<div id="tabscontent">





  <!-- USERS -->
  <a name="tabusers"></a>
  <div id="tabscontent_users">

  <?php if ( $is_admin ) { ?>
    <a title="Add New User" href="edit_user.php" target="useriframe" onclick="javascript:show('useriframe');">Add New User</a><br />
    <ul>
    <?php 
    $userlist = user_get_users ();
    for ( $i = 0; $i < count ( $userlist ); $i++ ) {
      if ( $userlist[$i]['cal_login'] != '__public__' ) {
	echo "<li><a title=\"" . 
	  $userlist[$i]['cal_fullname'] . "\" href=\"edit_user.php?user=" . 
	  $userlist[$i]["cal_login"] . "\" target=\"useriframe\" onclick=\"javascript:show('useriframe');\">";
	echo $userlist[$i]['cal_fullname'];
	echo "</a>";
	if (  $userlist[$i]["cal_is_admin"] == 'Y' )
	  echo "&nbsp;<abbr title=\"" . translate("denotes administrative user") . "\">*</abbr>";
	echo "</li>\n";
      }
    }
    ?>
    </ul>
    *&nbsp; denotes administrative user<br />
    <iframe name="useriframe" id="useriframe" style="width:90%;border-width:0px; height:350px;"></iframe>
  <?php } else { ?>
    <iframe src="edit_user.php" name="accountiframe" id="accountiframe" style="width:90%;border-width:0px; height:350px;"></iframe>
  <?php } ?>
  </div>


  <!-- BUDDIES -->
  <a name="tabbuddies"></a>
  <div id="tabscontent_buddies">

  The buddy system allows you to select other users to sign you up for meals and crew shifts. Note that you can ask the meal coordinator to sign you up for meals and shifts even if s/he is not your buddy. <p />


    <table>
    <tr>
    <td><h3>The following people may sign you up for meals and shifts:</h3></td>
    </tr><tr>
    <td><ul class="buttonlist">
    <?php 
    $signer_list = get_signers ();
    if ( count ( $signer_list ) == 0 ) {
      echo "<li>None</li>";
    } else {
      for ( $i = 0; $i < count( $signer_list ); $i++ ) {
	echo "<li>" . $signer_list[$i]['cal_fullname'] . 
	  "&nbsp;&nbsp;&nbsp;<a name=\"removebuddy\" class=\"addbutton\"" .
	  "href=\"edit_buddy_handler.php?removebuddy=" . 
	  $signer_list[$i]['cal_login'] .
	  "\">Remove</a>" . "</li>";
      }
    }?>
    </ul></td>
    </tr>
    <tr>
    <form action="edit_buddy_handler.php" method="post">

    <td>To allow another person to sign you up, select their name and click "Add buddy":</td>
    <td><select name="newbuddy">
    <?php 
      $prosp_list = get_nonsigners ();
      for ( $i = 0; $i < count( $prosp_list ); $i++ ) {
	echo "<option value=\"" . $prosp_list[$i]['cal_login'] .
	  "\">" . $prosp_list[$i]['cal_fullname'] . 
	  "</option>";
      }
      echo "</select>";
    ?>
    <input type="submit" value="Add buddy" /></td>
    </form>
    </tr>

    <tr>
    <td><h3>You may sign up the following people for meals and shifts:</h3></td>
    </tr><tr>
    <td><ul>
    <?php 
    if ( $is_admin || $is_meal_coordinator ) {
      echo "<li>Everybody (as meal coordinator or admin)</li>";
    } else {
      $signee_list = get_signees ( $login );
      if ( count ( $signee_list ) == 0 ) {
	echo "<li>None</li>";
      } else {
	for ( $i = 0; $i < count( $signee_list ); $i++ ) {
	  echo "<li>" . $signee_list[$i]['cal_fullname'] . "</li>";
	}
      }
    }?>
    </ul></td>
    </tr>
    </table>


  </form>

  </div>



</div>

<script language="JavaScript" type="text/javascript">
showTab('users');
</script>


<?php print_trailer(); ?>
</body>
</html>

