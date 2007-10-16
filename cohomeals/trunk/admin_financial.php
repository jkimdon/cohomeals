<?php
include_once 'includes/init.php';
include_once 'includes/munge_date.php';

$INC = array('js/visible.php');
print_header( $INC );
?>

<script type="text/javascript">
var tabs = new Array();
tabs[1] = "add";
tabs[2] = "show";

<!-- <![CDATA[
function selectMeal( mealid ) {
  url = "datesel.php?form=addfinancialform&sendid=true&fday=day&fmonth=month&fyear=year";
  window.open( url, "Select meal", "width=280,height=300,scrollbars=no,toolbar=no");
}
//]]> -->

</script>


<?php

$cur_group = "";
$cur_group = mysql_safe( getGetValue( 'billing' ), true );

$mealid = 0;

$can_view = false;
if ( $is_meal_coordinator || $is_beancounter ) {
  $can_view = true;
}


if ( $can_view == true ) {
?>
  <h2>Financial logs</h2>
     
  <!-- TABS -->
  <div id="tabs">
   <span class="tabfor" id="tab_show"><a href="#tabshow" onclick="return showTab('show')">Logs</a></span>
   <span class="tabbak" id="tab_add"><a href="#tabadd" onclick="return showTab('add')">Add entry</a></span>
  </div>


  <!-- TABS BODY -->
  <div id="tabscontent">



   <!-- VIEW EVENTS -->
   <a name="tabshow"></a>
   <div id="tabscontent_show">

   <form action="admin_financial.php" method="get" name="financial_chooseuser_form">
   Select billing group to view: 
   <select name="billing">
   <?php 
   echo "<option";
   if ( $cur_group == "" )
     echo " selected=\"selected\"";
   echo " value=\"all\">All</option>";
   $groups = get_billing_groups();
   for ( $i=0; $i<count( $groups ); $i++ ) {
     $group = $groups[$i];
     echo "<option value=\"$group\"";
     if ( $group == $cur_group ) 
       echo " selected=\"selected\"";
     echo ">$group</option>\n";
   } ?>
   </select>


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



   <?php /// display selected
   display_financial_log( $cur_group, $startdate, $enddate );
   ?>
   </div>


     

  <!-- ADD EVENT -->
  <a name="tabadd"></a>
  <div id="tabscontent_add">

  <form action="add_financial_handler.php" method="post" name="addfinancialform">
  
  <table style="border-width:0px;">
  <tr>
   <td class="tooltip">Billing group affected:</td>
   <td><select name="billing">
    <?php 
    $groups = get_billing_groups();
    for ( $i=0; $i<count( $groups ); $i++ ) {
      $group = $groups[$i];
      echo "<option value=\"$group\">$group</option>\n";
    } ?>
    </select></td>
   </tr>


   <tr>
    <td class="tooltip">Amount:</td>
    <td><input type="text" name="dollars" id="dollars" size="3" maxlength="3"/>.<input type="text" name="cents" id="cents" size="2" maxlength="2"/></td>
   </tr>


   <tr>
    <td class="tooltip">Transaction type:</td>
    <td>
     <label><input type="radio" name="type" value="credit" checked="checked"/>&nbsp;Credit</label>	 
     <label><input type="radio" name="type" value="debit" />&nbsp;Debit</label>
    </td>
   </tr>


   <tr>
    <td class="tooltip">Brief description:</td>  
    <td><input type="text" name="description" id="description" size="40" maxlength="80"/></td>
   </tr>


   <tr>
    <td class="tooltip">Associated meal (optional):</td>
    <td><input type="button" name="meal" id="meal" value="Choose meal" onclick="selectMeal( <?php echo $mealid; ?> )" />
     <input type="hidden" name="mealid" value="" /> 
    </td>
   </tr>


   <tr>
    <td class="tooltip">Notes (optional):</td>
    <td><textarea name="notes" rows="5" cols="40"></textarea></td>
   </tr>

   <tr>
    <td><input type="submit" value="Submit" /></td>
   </tr>

   </table>
   </form>
   </div>




  </div>


<?php
} // end $can_add == true

?>


<script language="JavaScript" type="text/javascript">
showTab('show');
</script>



<?php print_trailer(); ?>
</body>
</html>

