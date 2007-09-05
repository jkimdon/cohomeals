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
<form action="month.php" method="get" name="SelectMonth" id="monthform">
<label for="monthselect"><?php etranslate("Month")?>:&nbsp;</label>
<select name="date" id="monthselect" onchange="document.SelectMonth.submit()">
<?php
  if ( ! empty ( $thisyear ) && ! empty ( $thismonth ) ) {
    $m = $thismonth;
    $y = $thisyear;
  } else {
    $m = date ( "m" );
    $y = date ( "Y" );
  }
  $d_time = mktime ( 3, 0, 0, $m, 1, $y );
  $thisdate = date ( "Ymd", $d_time );
  $y--;
  for ( $i = 0; $i < 25; $i++ ) {
    $m++;
    if ( $m > 12 ) {
      $m = 1;
      $y++;
    }
    $d = mktime ( 3, 0, 0, $m, 1, $y );
    echo "<option value=\"" . date ( "Ymd", $d ) . "\"";
    if ( date ( "Ymd", $d ) == $thisdate ) {
      echo " selected=\"selected\"";
    }
    echo ">";
    echo date_to_str ( date ( "Ymd", $d ), $DATE_FORMAT_MY, false, true );
    echo "</option>\n";
  }
?>
</select>
<input type="submit" value="<?php etranslate("Go")?>" />
</form>


<form action="year.php" method="get" name="SelectYear" id="yearform">
<label for="yearselect"><?php etranslate("Year")?>:&nbsp;</label>
<select name="year" id="yearselect" onchange="document.SelectYear.submit()">
<?php
  if ( ! empty ( $thisyear ) ) {
    $y = $thisyear;
  } else {
    $y = date ( "Y" );
  }
  for ( $i = $y - 4; $i < $y + 4; $i++ ) {
    echo "<option value=\"$i\"";
    if ( $i == $y ) {
      echo " selected=\"selected\"";
    }
    echo ">$i</option>\n";
  }
?>
</select>
<input type="submit" value="<?php etranslate("Go")?>" />
</form>
<div id="menu">

<?php
$goto_link = array ( );
$reports_link = array ( );
$manage_calendar_link = array ( );

// Go To links
$can_add = false;
if ( $is_meal_coordinator || $is_admin ) {
  $can_add = true;
}


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
if ( ! strstr ( $reqURI, "month.php" ) &&
   ! strstr ( $reqURI, "week.php" ) &&
   ! strstr ( $reqURI, "day.php" ) ) {
  $todayURL = 'day.php';
} else {
  $todayURL = $reqURI;
}

$goto_link[] = "<a title=\"Calendar\" " .
  "href=\"$mycal\">" . 
translate("Calendar") . "</a>";

if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"User info\" href=\"adminhome.php\">User info</a>";
}
if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"Financial history\" href=\"financeHistory.php\">Financial history</a>";
}
if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"Work/eat history\" href=\"workeatHistory.php\">Work/eat history</a>";
}
if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"Recipes\" href=\"recipes.php\">Recipes</a>";
}


/// adding/subscribing links
$subscribe_link[] = "<a href=\"subscribe_heart.php\">Heart</a>";
$subscribe_link[] = "<a href=\"subscribe_club.php\">Club</a>";
if ( $can_add ) {
  $url = "<a title=\"" . 
    translate("Add New Meal") . "\" href=\"edit_entry.php";
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
}

if ( $login != '__public__' ) {
  $goto_link[] = "<a title=\"" . 
    translate("Help") . "\" href=\"#\" onclick=\"window.open " .
    "( 'help_index.php', 'cal_help', 'dependent,menubar,scrollbars, " .
    "height=400,width=400,innerHeight=420,outerWidth=420' );\"  " .
    "onmouseover=\"window.status='" . 
    translate("Help") . "'\">" . 
    translate("Help") . "</a>";
}

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
