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
<?php
  if ( ! empty ( $user ) && $user != $login ) {
    echo "<input type=\"hidden\" name=\"user\" value=\"$user\" />\n";
  }
  if ( ! empty ( $cat_id ) && $categories_enabled == "Y"
    && ( ! $user || $user == $login ) ) {
    echo "<input type=\"hidden\" name=\"cat_id\" value=\"$cat_id\" />\n";
  }
?>
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
<?php
  if ( ! empty ( $user ) && $user != $login ) {
    echo "<input type=\"hidden\" name=\"user\" value=\"$user\" />\n";
  }
  if ( ! empty ( $cat_id ) && $categories_enabled == "Y"
    && ( ! $user || $user == $login ) ) {
    echo "<input type=\"hidden\" name=\"cat_id\" value=\"$cat_id\" />\n";
  }
?>
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
$views_link = array ( );
$reports_link = array ( );
$manage_calendar_link = array ( );

// Go To links
$can_add = ( $readonly == "N" );
if ( $public_access == "Y" && $public_access_can_add != "Y" &&
  $login == "__public__" ) {
  $can_add = false;
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

if ( ! empty ( $user ) && $user != $login ) {
  $goto_link[] = "<a title=\"" . 
    translate("My Calendar") . "\" style=\"font-weight:bold;\" " .
    "href=\"$mycal\">" . 
    translate("Back to My Calendar") . "</a>";
} else {
  $goto_link[] = "<a title=\"" . 
    translate("Calendar") . "\" style=\"font-weight:bold;\" " .
    "href=\"$mycal\">" . 
    translate("Calendar") . "</a>";
}
if ( ! empty ( $user ) && $user != $login ) {
  $todayURL .= '?user=' . $user;
}
if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"" . 
    translate("User info") . "\" style=\"font-weight:bold;\" " .
    "href=\"adminhome.php\">" . 
    translate("User info") . "</a>";
}
if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"" . 
    translate("Financial history") . "\" style=\"font-weight:bold;\" " .
    "href=\"financeHistory.php\">" . 
    translate("Financial history") . "</a>";
}
if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"" . 
    translate("Work/eat history") . "\" style=\"font-weight:bold;\" " .
    "href=\"workeatHistory.php\">" . 
    translate("Work/eat history") . "</a>";
}
if ( $login != '__public__' && $readonly == 'N' ) {
  $goto_link[] = "<a title=\"" . 
    translate("Recipes") . "\" style=\"font-weight:bold;\" " .
    "href=\"recipes.php\">" . 
    translate("Recipes") . "</a>";
}

// only display some links if we're viewing our own calendar.
if ( empty ( $user ) || $user == $login ) {
  $goto_link[] = "<a title=\"" . 
    translate("Search") . "\" href=\"search.php\">" .
    translate("Search") . "</a>";
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
    $url .= "\">" . translate("Add New Meal") . "</a>";
    $goto_link[] = $url;
  }
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
