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

  <span class="tabbak" id="tab_foodpref"><a href="#tabfoodpref" onclick="return showTab('foodpref')">Food restrictions</a></span>

  <span class="tabfor" id="tab_users"><a href="#tabusers" onclick="return showTab('users')">
  <?php if ($is_meal_coordinator) {
    echo "Users";
  } else {
    echo "Account";
  }?>
  </a></span>

  <span class="tabbak" id="tab_buddies"><a href="#tabbuddies" onclick="return showTab('buddies')">Buddies</a></span>

  <span class="tabbak" id="tab_kidprices"><a href="#tabkidprices" onclick="return showTab('kidprices')">Kid prices</a></span>

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
	  echo "&nbsp;<abbr title=\"denotes administrative user\">*</abbr>";
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



  <!-- KID PRICES -->
  <a name="tabkidprices"></a>
  <div id="tabscontent_kidprices">
	People currently in your billing group are as follows:<br>
	<dl>
<?php 
$billing_group = get_billing_group( $login );
$sql = "SELECT cal_login, cal_firstname, cal_lastname FROM webcal_user " .
  "WHERE cal_billing_group = '" . $billing_group . "'";
if ( $res = dbi_query( $sql ) ) {
  while ( $row = dbi_fetch_row( $res ) ) {
    $child_login = $row[0];
    $child_realname = $row[1] . " " . $row[2];
    print_change_kid_price( $child_login, $child_realname );
  }
}
?>
</dl>

<?php 

  //// admin can change any kids
if ( $is_meal_coordinator ) {

  echo "<hr><p>Admin can change any child:</p>";

  $names = user_get_users(); // only gets active users

  foreach ( $names as $name ) {
    $raw_fee_category = get_fee_category( 0, $name['cal_login'], true );
    if ( $raw_fee_category != 'A' ) { // only list children
      print_change_kid_price( $name['cal_login'], $name['cal_fullname'] );
    }
  }

}
?>
  </div>



  <!-- FOOD RESTRICTIONS -->
  <a name="tabfoodpref"></a>
  <div id="tabscontent_foodpref">

  <p>Your personal food restrictions are as follows. Adapt as needed, though please limit yourself to restrictions rather than preferences since it can be a lot of work for chefs to accommodate food needs for many people.</p>

  <p> Please include details in the comments section such as suggested alternatives, if small amounts are ok, or anything else that might be useful for a chef who is trying to accommodate your needs.</p>

    <p><table>
    <tr class="d1"><td>Food</td><td></td><td>Comments</td><td></td></tr>
    <tr><td colspan="4"><hr></td></tr>

  <?php 

    $row_num = 0;

    $sql = "SELECT cal_food, cal_comments " .
     "FROM webcal_food_prefs " .
     "WHERE cal_login = '$login' " . 
     "ORDER BY cal_food";

    if ( $res = dbi_query( $sql ) ) {
      $prev_food = "";
      $row_num = 0;
      
      $i = 0;
      while ( $row = dbi_fetch_row( $res ) ) {
	$food = $row[0];
	$comments = $row[1];
	echo "<tr class=\"d$row_num\"><td>" . $food . "</td>";
	echo "<td><a name=\"removefood\" class=\"addbutton\"" . 
	  "href=\"edit_food_restrictions_handler.php?action=remove&food=" . $food .
	  "\">Remove</a></td>";
	$row_num = ( $row_num == 1 ) ? 0:1;
	$comment_frame = "editcommentiframe" . $i;
	$i++;
	echo "<td>" . $comments . 
	  "<iframe name=\"$comment_frame\" id=\"$comment_frame\" style=\"display:none;\"></iframe>" . "</td>";
	$nexturl = "food_comments.php?food=$food";
	echo "<td><a href=\"$nexturl\" class=\"addbutton\" target=\"$comment_frame\" onclick=\"javascript:show('$comment_frame');\">" .
	  "Edit</a></td>";
	echo "</tr>";
      }
      
      echo "</td></tr>";
      
      dbi_free_result( $res );
    } else echo "</td></tr>";
?>
    
    </table></p>

    <p>
    <form action="edit_food_restrictions_handler.php" method="post">
    <input type="hidden" name="action" value="add" />
      
    <b>Add another food:</b>&nbsp; <select name="food">
      <?php
      $sql = "SELECT DISTINCT cal_food FROM webcal_food_prefs ORDER BY cal_food";

      if ( $res = dbi_query( $sql ) ) {
	while ( $row = dbi_fetch_row( $res ) ) {
	  $food_name = $row[0];
	  echo "<option value=\"" . $food_name . "\">" . $food_name . "</option>";
	}
      }
      ?>
    <input type="submit" class="addbutton" value="Submit" />
    </form>
    </p>



    <p>If you need to add a food not on the list, please contact Dave Demaree</p>

    <hr>


    <?php 
     if ( $is_meal_coordinator ) {
	 echo "<p><h4>Everyone's preferences</h4> (highlighted names have mouse-over details)</p><table>\n";

	 $sql = "SELECT cal_food, cal_login, cal_comments FROM webcal_food_prefs ";
	 $sql .= "ORDER BY cal_food";
	 
	 if ( $res = dbi_query( $sql ) ) {
	     $prev_food = "";
	     $row_num = 0;
	     
	     while ( $row = dbi_fetch_row( $res ) ) {
		 $food = $row[0];
		 $food_pref_login = $row[1];
		 $comments = $row[2];
		 if ( $food != $prev_food ) {
		     echo "</td></tr><tr class=\"d$row_num\"><td>" . $food . "</td><td>";
		     $first = true;
		     $row_num = ( $row_num == 1 ) ? 0:1;
		 } 
		 
		 if ( $first == true ) $first = false;
		 else echo ", ";
		 print_food_pref_person( $food_pref_login, $row[2] );
		 $prev_food = $food;
	     }

	     echo "</td></tr>";
	     
	     dbi_free_result( $res );
	 }
	 echo "</table>\n";
     }?>

  </div>


</div>

<script language="JavaScript" type="text/javascript">
showTab('foodpref');
</script>


<?php print_trailer(); ?>
</body>
</html>

<?php

function print_change_kid_price ( $child_login, $child_realname ) {

  $raw_fee_category = get_fee_category( 0, $child_login, true );
  $altered_fee_category = get_fee_category( 0, $child_login );
  if ( $raw_fee_category == "A" ) {
    echo "<dt> <b>" . $child_realname . "</b><dd>current price point: Adult (full price)";
  } else {
    switch ( $altered_fee_category ) {
    case "F":
      $print_fee = "Child: Free/no cost (default for ages 0-9)";
      break;
    case "Q":
      $print_fee = "Child: Quarter-price";
      break;
    case "K":
      $print_fee = "Child: Half-price (default for ages 10-13)";
      break;
    case "T":
      $print_fee = "Child: Three-quarter-price";
      break;
    case "A":
      $print_fee = "Child: Full price";
      break;
    }
    echo "<dt> <b>" . $child_realname . " </b> <dd>current price point: $print_fee. To change price point, select: ";
    ?>
    <form action="edit_kid_prices_handler.php" method="post">
       <input type="hidden" name="child_login" value="<?php echo $child_login;?>"/>
       <select name="new_fee_category">
       <option value="A">Full price</option>
       <option value="T">Three-quarters price</option>
       <option value="K">Half price (default for ages 10-13)</option>
       <option value="Q">Quarter price</option>
       <option value="F">Free/no cost (default for ages 0-9)</option>
       </select>
       <input type="submit" class="addbutton" value="Submit change" />
    </form>
    </p>
    <?php
  }
}
 

?>