<?php
include_once 'includes/init.php';

print_header();
?>

<h1>Food restrictions for all meal program participants.</h1>

<table>
<tr><td><b>Food</b></td><td><b>Names</b> (highlighted names have mouse-over comments)</td></tr>
    <tr><td colspan="2"><hr></td></tr>

<?php

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

echo "</table>";


print_trailer ();
?>
</body>
</html>
