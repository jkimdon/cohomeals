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
	<?php
	<tr><td class="help">
	<?php etranslate("Participants")?>:</td><td>
	<?php etranslate("participants-help")?>
	</td></tr>
</table>

<?php include_once "includes/help_trailer.php"; ?>

</body>
</html>
