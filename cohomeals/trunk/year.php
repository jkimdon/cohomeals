<?php
include_once 'includes/init.php';
send_no_cache_header ();

if ( empty ( $year ) )
  $year = date("Y");

$thisyear = $year;
if ( $year != date ( "Y") )
  $thismonth = 1;
//set up global $today value for highlighting current date
set_today($date);
if ( $year > "1903" )
  $prevYear = $year - 1;
else
  $prevYear=$year;

$nextYear= $year + 1;

if ( $allow_view_other != "Y" && ! $is_meal_coordinator )
  $user = "";

/* Pre-load the events for quicker access */
$events = read_events ( $year . "0101", $year . "1231" );

 print_header();
 ?>
 
<div class="title">
	<a title="<?php etranslate("Previous")?>" class="prev" href="year.php?year=<?php echo $prevYear; if ( ! empty ( $user ) ) echo "&amp;user=$user";?>"><img src="leftarrow.gif" alt="<?php etranslate("Previous")?>" /></a>
	<a title="<?php etranslate("Next")?>" class="next" href="year.php?year=<?php echo $nextYear; if ( ! empty ( $user ) ) echo "&amp;user=$user";?>"><img src="rightarrow.gif" alt="<?php etranslate("Next")?>" /></a>
	<span class="date"><?php echo $thisyear ?></span>
	<span class="user"><?php
		echo "<br />\n";
		if ( ! empty ( $user ) ) {
			user_load_variables ( $user, "user_" );
			echo $user_fullname;
		} else {
			echo $fullname;
		}
	?></span>
</div>
<br />
 
<div align="center">
	<table class="main">
		<tr><td>
			<?php display_small_month(1,$year,False); ?></td><td>
			<?php display_small_month(2,$year,False); ?></td><td>
			<?php display_small_month(3,$year,False); ?></td><td>
			<?php display_small_month(4,$year,False); ?>
		</td></tr>
		<tr><td>
			<?php display_small_month(5,$year,False); ?></td><td>
			<?php display_small_month(6,$year,False); ?></td><td>
			<?php display_small_month(7,$year,False); ?></td><td>
			<?php display_small_month(8,$year,False); ?>
		</td></tr>
		<tr><td>
			<?php display_small_month(9,$year,False); ?></td><td>
			<?php display_small_month(10,$year,False); ?></td><td>
			<?php display_small_month(11,$year,False); ?></td><td>
			<?php display_small_month(12,$year,False); ?>
		</td></tr>
	</table>
</div>

<br />
<?php print_trailer(); ?>
</body>
</html>
