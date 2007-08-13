<?php
	include_once 'includes/init.php';
	print_header('','','',true);
?>

<h2><?php etranslate("Help")?>: <?php etranslate("Adding/Editing Calendar Entries")?></h2>

<table style="border-width:0px;">
	<tr><td class="help">
		<?php etranslate("Brief Description")?>:</td><td>
		<?php etranslate("brief-description-help")?>
	</td></tr>
	<tr><td class="help">
		<?php etranslate("Full Description")?>:</td><td>
		<?php etranslate("full-description-help")?>
	</td></tr>
	<tr><td class="help">
		<?php etranslate("Date")?>:</td><td>
		<?php etranslate("date-help")?>
	</td></tr>
	<tr><td class="help">
		<?php etranslate("Time")?>:</td><td>
		<?php etranslate("time-help")?>
	</td></tr>
   <?php if ( $GLOBALS['TIMED_EVT_LEN'] != 'E' ) { ?>
	<tr><td class="help">
		<?php etranslate("Duration")?>:</td><td>
		<?php etranslate("duration-help")?>
	</td></tr>
   <?php } else { ?>
	<tr><td class="help">
 		<?php etranslate("End Time")?>:</td><td>
 		<?php etranslate("end-time-help")?>
 	</td></tr>
   <?php } ?>
	<?php if ( $disable_priority_field != "Y" ) { ?>
		<tr><td class="help">
			<?php etranslate("Priority")?>:</td><td>
			<?php etranslate("priority-help")?>
		</td></tr>
	<?php } ?>
	<?php if ( $disable_access_field != "Y" ) { ?>
		<tr><td class="help">
			<?php etranslate("Access")?>:</td><td>
			<?php etranslate("access-help")?>
		</td></tr>
	<?php } ?>
	<?php
	<tr><td class="help">
	<?php etranslate("Participants")?>:</td><td>
	<?php etranslate("participants-help")?>
	</td></tr>
</table>

<?php include_once "includes/help_trailer.php"; ?>

</body>
</html>
