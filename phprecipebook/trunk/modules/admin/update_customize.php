<?php
// Exit if not admin
if (!$SMObj->checkAccessLevel($SMObj->getSuperUserLevel()))
	die($LangUI->_('You must have Administer privilages in order to customize the database!'));

$edit_table = isset( $_POST['edit_table'] ) ? $_POST['edit_table'] : '';
$mode = isset( $_POST['mode'] ) ? $_POST['mode'] : '';
$total_entries = isset( $_POST['total_entries'] ) ? $_POST['total_entries'] : 0;
$new_desc = isset( $_POST['new_desc'] ) ? $_POST['new_desc'] : '';
$new_text = isset( $_POST['new_text'] ) ? $_POST['new_text'] : '';

if ($mode == "add") 
{
	if (count($db_fields[$edit_table]) == 2)
	{
		$sql = "INSERT INTO $edit_table (" . $db_fields[$edit_table][1] . ") VALUES ('" . htmlspecialchars(trim($new_desc), ENT_QUOTES) . "')";
	}
	else if (count($db_fields[$edit_table]) == 3)
	{
		$sql = "INSERT INTO $edit_table (" . 
			$db_fields[$edit_table][1] . "," .
			$db_fields[$edit_table][2] . ") VALUES ('" . 
			htmlspecialchars(trim($new_desc), ENT_QUOTES) . "','" . 
			trim($new_text) . "')";
	}
	$rc = $DB_LINK->Execute( $sql );
	echo $LangUI->_('New Entry Added') . "<br />";
} else {
	$error = false;
	for ($i=0; $i<$total_entries; $i++) {
		$entry_delete = "delete_".$i;
		$entry_id = "entry_".$i;
		$entry_desc = "desc_".$i;
		$entry_text = "text_".$i;
		if (isset($_POST[$entry_delete])) {
			// then delete it from the database
			$sql = "DELETE FROM $edit_table WHERE " . $db_fields[$edit_table][0] . "=" . $_POST[$entry_id];
			$result = $DB_LINK->Execute($sql);
			DBUtils::checkResult($result, NULL, NULL, $sql);
		} else {
			// update the entry to the new value

			$sql = "UPDATE $edit_table SET " . $db_fields[$edit_table][1] . "='" . 
					htmlspecialchars(trim($_POST[$entry_desc]), ENT_QUOTES) . "'";

			if (count($db_fields[$edit_table]) == 3)
			{
				$sql .= "," . $db_fields[$edit_table][2] . "='" . str_replace("'", "\'", trim($_POST[$entry_text])) . "'";
			}
	
			$sql .= " WHERE " . $db_fields[$edit_table][0] . "=" . $_POST[$entry_id];
			$result = $DB_LINK->Execute($sql);
			DBUtils::checkResult($result, NULL, NULL, $sql);
		}
	}
	echo $LangUI->_('Table Updated') . "<br />";
}
?>