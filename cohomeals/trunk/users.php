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
  <?php if ($is_meal_coordinator) {
    echo "Users";
  } else {
    echo "Account";
  }?>
  </a></span>

  <span class="tabbak" id="tab_buddies"><a href="#tabbuddies" onclick="return showTab('buddies')">Buddies</a></span>

  <span class="tabbak" id="tab_foodpref"><a href="#tabfoodpref" onclick="return showTab('foodpref')">Food restrictions</a></span>

</div>


<!-- TABS BODY -->

<div id="tabscontent">





  <!-- USERS -->
  <a name="tabusers"></a>
  <div id="tabscontent_users">

  <?php if ( $is_meal_coordinator ) { ?>
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
	if (  $userlist[$i]["cal_is_meal_coordinator"] == 'Y' )
	  echo "&nbsp;<abbr title=\"" . translate("denotes administrative user") . "\">*</abbr>";
	echo "</li>\n";
      }
    }
    ?>
    </ul>
    *&nbsp; denotes administrative user<br />
    <iframe name="useriframe" id="useriframe" style="width:100%;border-width:0px; height:450px;"></iframe>
  <?php } else { ?>
    <iframe src="edit_user.php" name="accountiframe" id="accountiframe" style="width:100%;border-width:0px; height:400px;"></iframe>
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
    if ( $is_meal_coordinator ) {
      echo "<li>Everybody (as meal coordinator)</li>";
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


  <!-- FOOD RESTRICTIONS -->
  <a name="tabfoodpref"></a>
  <div id="tabscontent_foodpref">

    Your personal food restrictions are as follows. Contact the meal coordinator to update them.
    <p><table>
    <tr class="d1"><td>Food</td><td>Reason</td><td>Request level</td></tr>
    <tr><td><hr></td><td><hr></td><td><hr></td></tr>

    <?php
    $row_num = 0;
    $prefs = array();
    $prefs = user_get_food_prefs( $login );
    
    for ( $i=0; $i<count( $prefs ); $i++ ) {
      $pref = $prefs[$i];
      echo "<tr class=\"d$row_num\"><td>" . $pref['food'] . "</td>" .
	"<td>" . $pref['reason'] . "</td>" . 
	"<td>" . $pref['level'] . " </td></tr>\n";
      $row_num = ( $row_num == 1 ) ? 0:1;
    }
    ?>
    
    </table></p>

    <p>Reminder:<br>
    <b>Request level 1:</b> No request for Meal Crew:  I will take one or more steps, such as--eat the rest of the meal, or pick this ingredient out of a dish, or sometimes eat some of this food, or bring my own alternative food.<br>
    <b>Request level 2:</b> Request some changes to menu that would increase Meal Crew's time/complexity <10%, such as serving item as a side dish so I can skip it, making simple variations of the same dish and leaving this food out of one version (like soup with either milk or soy milk), or serving alternative item purchased from store (like corn tortillas in addition to flour tortillas for burrito bar).<br>
    <b>Request level 3:</b> Request more changes to menu that would increase Meal Crew's time/complexity >10%, such as serving precooked portions of an alternative dish, or cooking a separate alternative dish, or using unfamiliar ingredients or procedures.
   </p>
    
 
  </div>


</div>

<script language="JavaScript" type="text/javascript">
showTab('users');
</script>


<?php print_trailer(); ?>
</body>
</html>

