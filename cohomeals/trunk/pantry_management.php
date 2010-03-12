<?php
include_once 'includes/init.php';

print_header();
?>

<h1>Pantry food management</h1>

<a class="addbutton" href="print_pantry.php">Print current price list</a>

<?php

if ( $is_meal_coordinator || $is_beancounter ) {

  ?>
  <form action="pantry_management_handler.php" method="post">

    <p>Note: Flags are O = organic, L = local, S = spray-free, D = grower direct</p>

  <h2>Current foods:</h2>

  (Make changes in the text boxes.)

  <table class="bordered_table">
  <tr><td>Category</td><td>Food</td><td>Unit price</td><td>Flags (OLSD)</td><td>Currently available</td><td>Available for individual purchase</td><td>Notes</td></tr>

  <?php
  $sql = "SELECT cal_food_id, cal_description, cal_category, cal_unit, cal_unit_price, cal_available_meals, cal_available_individuals, cal_flags, cal_notes " .
    "FROM webcal_pantry_food WHERE cal_category != '__special'" .
    "ORDER BY cal_category, cal_available_meals DESC";
  $res = dbi_query( $sql );
  $row_num = 1;
  while ( $row = dbi_fetch_row( $res ) ) {
    $food_id = $row[0];
    $description = $row[1];
    $category = $row[2];
    $unit = $row[3];
    $old_price = $row[4];
    $avail_meals = $row[5];
    $avail_indiv = $row[6];
    $flags = $row[7];
    $notes = $row[8];

    echo "<tr class=\"n$row_num\">";
    $row_num = ( $row_num == 1 ) ? 0:1;
    echo "<td>$category &nbsp;(<input type=\"text\" name=\"changeCat$food_id\" size=\"10\" maxlength=\"70\"></input>)</td>";
    echo "<td>$description &nbsp;(<input type=\"text\" name=\"changeDescription$food_id\" size=\"10\" maxlength=\"70\"></input>)</td>";
    echo "<td>" . price_to_str( $old_price ) . 
      "/$unit &nbsp;($<input type=\"text\" name=\"changeDollar$food_id\" size=\"2\" maxlength=\"2\"/>.<input type=\"text\" name=\"changeCents$food_id\" size=\"2\" maxlength=\"2\"/>/$unit)</td>";
    echo "<td>$flags &nbsp;(<input type=\"text\" name=\"changeFlags$food_id\" size=\"4\" maxlength=\"4\"></input>)</td>";
    if ( $avail_meals == 1 ) echo "<td>Yes";
    else echo "<td>No";
    echo "&nbsp;(<input type=\"checkbox\" name=\"toggleAvail$food_id\">change</input>)</td>";

    if ( $avail_indiv == 1 ) echo "<td>Yes";
    else echo "<td>No";    
    echo "&nbsp;(<input type=\"checkbox\" name=\"toggleIndiv$food_id\">change</input>)</td>";

    echo "<td>$notes <br>(<input type=\"text\" name=\"changeNotes$food_id\" size=\"5\" maxlength=\"75\"/>)</td>";
    echo "</td>";
    
  }

  ?>
  </table>

  <h2>New foods:</h2>
  <table class="bordered_table">
      <tr><td>Category</td><td>Description</td><td>unit (e.g. cup)</td><td colspan=2>price per unit</td><td>Flags(OLSD)</td><td>Currently available?</td><td>Available for individual purchase?</td><td>Optional notes</td></tr>


  <tr>
  <td><input type="text" name="newcat1" size="15" maxlength="50"/></td>
  <td><input type="text" name="newdescr1" size="15" maxlength="75"/></td>
  <td><input type="text" name="newunit1" size="10" maxlength="20"/></td>
  <td>$<input type="text" name="newdollars1" size="2" maxlength="3"/></td>
  <td>.<input type="text" name="newcents1" size="2" maxlength="2"/></td>
  <td>.<input type="text" name="newflags1" size="4" maxlength="4"/></td>
  <td><input type="radio" name="newavail1" value="y" checked="checked">Y</input>
      <input type="radio" name="newavail1" value="n">N</input></td>
  <td><input type="radio" name="newindiv1" value="y">Y</input>
      <input type="radio" name="newindiv1" value="n" checked="checked">N</input></td>
  <td><input type="text" name="newnotes1" size="15" maxlength="75"/></td>
  </tr>


  <tr>
  <td><input type="text" name="newcat2" size="15" maxlength="50"/></td>
  <td><input type="text" name="newdescr2" size="15" maxlength="75"/></td>
  <td><input type="text" name="newunit2" size="10" maxlength="20"/></td>
  <td>$<input type="text" name="newdollars2" size="2" maxlength="3"/></td>
  <td>.<input type="text" name="newcents2" size="2" maxlength="2"/></td>
  <td>.<input type="text" name="newflags2" size="4" maxlength="4"/></td>
  <td><input type="radio" name="newavail2" value="y" checked="checked">Y</input>
      <input type="radio" name="newavail2" value="n">N</input></td>
  <td><input type="radio" name="newindiv2" value="y">Y</input>
      <input type="radio" name="newindiv2" value="n" checked="checked">N</input></td>
  <td><input type="text" name="newnotes2" size="15" maxlength="75"/></td>
  </tr>


  <tr>
  <td><input type="text" name="newcat3" size="15" maxlength="50"/></td>
  <td><input type="text" name="newdescr3" size="15" maxlength="75"/></td>
  <td><input type="text" name="newunit3" size="10" maxlength="20"/></td>
  <td>$<input type="text" name="newdollars3" size="2" maxlength="3"/></td>
  <td>.<input type="text" name="newcents3" size="2" maxlength="2"/></td>
  <td>.<input type="text" name="newflags3" size="4" maxlength="4"/></td>
  <td><input type="radio" name="newavail3" value="y" checked="checked">Y</input>
      <input type="radio" name="newavail3" value="n">N</input></td>
  <td><input type="radio" name="newindiv3" value="y">Y</input>
      <input type="radio" name="newindiv3" value="n" checked="checked">N</input></td>
  <td><input type="text" name="newnotes3" size="15" maxlength="75"/></td>
  </tr>

  </table>


  <input type="submit" value="Submit changes" /><br>
  </form>

 <?php
 } else {
  echo "Not authorized.<br>";
 }


print_trailer ();
?>
</body>
</html>
