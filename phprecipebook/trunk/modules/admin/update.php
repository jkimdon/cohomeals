<?php
// Exit if not admin
if (!$SMObj->checkAccessLevel($SMObj->getSuperUserLevel()))
	die($LangUI->_('You must have Administer privilages in order to customize the database!'));

$edit_table = isset( $_POST['edit_table'] ) ? $_POST['edit_table'] : '';
$mode = isset( $_POST['mode'] ) ? $_POST['mode'] : '';
$total_entries = isset( $_POST['total_entries'] ) ? $_POST['total_entries'] : 0;
$list_order = isset( $_POST['list_order'] ) ? $_POST['list_order'] : '';
$new_entry = isset( $_POST['new_entry'] ) ? $_POST['new_entry'] : '';

if ($mode == "add") {
	$sql = "INSERT INTO $edit_table (" . $db_fields[$edit_table][1] . ") VALUES ('" . htmlentities(trim($new_entry)) . "')";
	$rc = $DB_LINK->Execute( $sql );
	echo $LangUI->_('Entry Added') . "<br />";
} else {
	$error = false;
	for ($i=0; $i<$total_entries; $i++) {
		$entry_delete = "delete_".$i;
		$entry_id = "entry_".$i;
		$entry_desc = "desc_".$i;
		if ($_POST[$entry_delete] == "yes") {
			// then delete it from the database
			$sql = "DELETE FROM $edit_table WHERE " . $db_fields[$edit_table][0] . "=" . $_POST[$entry_id];
			$result = $DB_LINK->Execute($sql);
			if (!$result) {
				$error=true;
				echo '<font color=red>'. $DB_LINK->ErrorMsg().'</font><p>';
			}
		} else {
			// update the entry to the new value
			$sql = "UPDATE $edit_table SET " . $db_fields[$edit_table][1] . "='" . 
						htmlentities(trim($_POST[$entry_desc])) . "'";
	
			$sql .= " WHERE " . $db_fields[$edit_table][0] . "=" . $_POST[$entry_id];
			$result = $DB_LINK->Execute($sql);
			if (!$result) {
				$error=true;
				echo '<font color=red>'. $DB_LINK->ErrorMsg().'</font><p>';
			}
		}
	}
	// If we are dealing with recipe_types, then update settings_list_order as well (the shopping list order)
	if ($edit_table==$db_table_types) {
			$sql = "UPDATE $db_table_settings SET setting_list_order='$list_order'";
			$result = $DB_LINK->Execute($sql);
			if (!$result) {
				$error=true;
				echo '<font color=red>'. $DB_LINK->ErrorMsg().'</font><p>';
			}
	}
	if (!$error)
		echo $LangUI->_('Table Updated') . "<br />";
}
?>