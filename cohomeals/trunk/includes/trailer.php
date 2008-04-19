<?php

if ( empty ( $PHP_SELF ) && ! empty ( $_SERVER ) &&
  ! empty ( $_SERVER['PHP_SELF'] ) ) {
  $PHP_SELF = $_SERVER['PHP_SELF'];
}
if ( ! empty ( $PHP_SELF ) && preg_match ( "/\/includes\//", $PHP_SELF ) ) {
    die ( "You can't access this file directly!" );
}

// NOTE: This file is included within the print_trailer function found
// in includes/init.php.  If you add a global variable somewhere in this
// file, be sure to declare it global in the print_trialer function
// or use $GLOBALS[].
?>

<div id="trailer">
<div id="menu">

<?php
$goto_link = array ( );
$reports_link = array ( );
$manage_calendar_link = array ( );

if ( ! empty ( $GLOBALS['STARTVIEW'] ) ) {
  $mycal = $GLOBALS['STARTVIEW'];
} else {
  $mycal = "index.php";
}

// calc URL to today
$todayURL = 'month.php';
$reqURI = 'month.php';
if ( ! empty ( $GLOBALS['SCRIPT_NAME'] ) ) {
  $reqURI = $GLOBALS['SCRIPT_NAME'];
} else if ( ! empty ( $_SERVER['SCRIPT_NAME'] ) ) {
  $reqURI = $_SERVER['SCRIPT_NAME'];
}
if ( ! strstr ( $reqURI, "month.php" ) ) {
  $todayURL = 'month.php';
} else {
  $todayURL = $reqURI;
}

$goto_link[] = "<a title=\"Calendar\" " .
  "href=\"$mycal\">" . 
translate("Calendar") . "</a>";

if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"User info\" href=\"users.php\">User info</a>";
}
if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"Financial history\" href=\"financeHistory.php\">Financial history</a>";
}
if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"Recipes\" href=\"recipes.php\">Recipes</a>";
}


/// adding/subscribing links
$subscribe_link[] = "<a href=\"subscribe_diamondBROKEN.php\">Diamond</a>";
$subscribe_link[] = "<a href=\"subscribe_heartBROKEN.php\">Heart</a>";
$subscribe_link[] = "<a href=\"subscribe_club.php\">Club</a>";
$url = "<a title=\"Add New Meal\" href=\"edit_entry.php";
if ( ! empty ( $thisyear ) ) {
  $url .= "?year=$thisyear";
  if ( ! empty ( $thismonth ) ) {
    $url .= "&amp;month=$thismonth";
  }
  if ( ! empty ( $thisday ) ) {
    $url .= "&amp;day=$thisday";
  }
}
$url .= "\">Add New Meal</a>";
$special_link[] = $url;

if ( $is_beancounter || $is_meal_coordinator ) {
  $url = "<a title=\"Add Financial Info\" ";
  $url .= "href=\"admin_financial.php?billing=all";
  $url .= "\">Group Finances</a>";
  $special_link[] = $url;
}
  

if ( $login != '__public__' ) {
  $goto_link[] = "<a title=\"Help\" href=\"#\" onclick=\"window.open " .
    "( 'help_index.php', 'cal_help', 'dependent,menubar,scrollbars, " .
    "height=400,width=400,innerHeight=420,outerWidth=420' );\"  " .
    "onmouseover=\"window.status='Help'\">Help</a>";
}

echo "<hr>";
if ( count ( $goto_link ) > 0 ) {
  ?><span class="prefix"><?php etranslate("Go to")?>:</span> <?php
  for ( $i = 0; $i < count ( $goto_link ); $i++ ) {
    if ( $i > 0 )
      echo " | ";
    echo $goto_link[$i];
  }
}


if ( count ( $subscribe_link ) > 0 ) {
  ?><br /><span class="prefix">Manage subscriptions:</span> <?php
  for ( $i = 0; $i < count ( $subscribe_link ); $i++ ) {
    if ( $i > 0 )
      echo " | ";
    echo $subscribe_link[$i];
  }
}


if ( count ( $special_link ) > 0 ) {
  ?><br /><span class="prefix">Special privileges:</span> <?php
  for ( $i = 0; $i < count ( $special_link ); $i++ ) {
    if ( $i > 0 )
      echo " | ";
    echo $special_link[$i];
  }
}

?>


<!-- CURRENT USER -->
<br />
<?php
if ( ! $use_http_auth ) {
 if ( empty ( $login_return_path ) )
  $login_url = "login.php";
 else
  $login_url = "login.php?return_path=$login_return_path";

 echo "<span class=\"prefix\"><a title=\"" .
 translate("Logout") . "\" href=\"$login_url\">" . 
 translate("Logout") . "</a>\n";
}

?>
</div>
</div>
<!-- /TRAILER -->
