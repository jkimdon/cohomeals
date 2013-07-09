<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}


// to be inserted at the end of the get_user_preference list in tiki-user_preferences.php

$tikilib->get_user_preference($userwatch, 'billingGroup', '');
$tikilib->get_user_preference($userwatch, 'birthdate', '32400');

$userGroups = $userlib->get_user_groups_inclusion($userwatch);
if (array_key_exists('CoHo owners', $userGroups) || array_key_exists('on-site renters', $userGroups)) {
  $tikilib->get_user_preference($userwatch, 'unitNumber', '');  
  $smarty->assign('showUnit', 'y');
} else {
  $smarty->assign('showUnit', 'n');
}

?>