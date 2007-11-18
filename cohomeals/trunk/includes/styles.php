<?php
if ( empty ( $PHP_SELF ) && ! empty ( $_SERVER ) &&
  ! empty ( $_SERVER['PHP_SELF'] ) ) {
  $PHP_SELF = $_SERVER['PHP_SELF'];
}
if ( ! empty ( $PHP_SELF ) && preg_match ( "/\/includes\//", $PHP_SELF ) ) {
    die ( "You can't access this file directly!" );
}
?>
<?php /* 

                   HOW TO READ THIS DOCUMENT

  Below are CSS styles used in WebCalendar.
  There are two main parts to every CSS style: 'selector' & 'declaration'
    EXAMPLE:
      body {
        color: red;
      }
  The selector in the example above is 'body', while its
  declaration is 'color: red;'
  Each declaration has two parts: 'property' & 'value'

  In the example above, there is only one declaraion ("color: red;")
  For that declaration, the PROPERTY is "color" and the VALUE is "red"

  NOTE: Each property must be followed by a colon (:), 
    and each value must be followed by a semi-colon (;)

  Each selector can contain multiple declarations
    EXAMPLE:
      body {
        color: red;
        font-size: 12px;
        background-color: black;
      }
  In the example above, there are three declarations:
      color: red;
      font-size: 12px;
      background-color: black;

  NOTE: The declarations for a given style must be contained within
    curly brackets ({ })

                  VARIABLES USED TO STYLE WEBCALENDAR

  TEXTCOLOR - default text color
  FONTS - default font-family
  BGCOLOR - background-color for the page
  TABLEBG - background-color for tables
    (typically used when the table also has cellspacing, thereby
    creating a border effect)
  CELLBG - background-color for normal cells
    (not weekends, today, or any other types of cells)
  TODAYCELLBG - background-color for cells that make up today's date
  WEEKENDBG - background-color for cells that make up the weekend
  THFG - text color for table headers
  THBG - background-color for table headers
  POPUP_FG - text color for event popups
  POPUP_BG - background-color for event popups
  H2COLOR - text color for text within h2 tags
*/
?>
<style type="text/css">
<!--
<?php /*==================== SECTION A ===============================

  The CSS for WebCalendar is broken down into several sections.
  This should make it easier to understand, debug & understand the
  logical sequence of how the style system is built.
  Each page in WebCalendar is assigned a unique ID. This unique ID is
  determined by taking the name of the page & removing any underscores (_).
  For a complete list of and their IDs, see includes/init.php or
  docs/WebCalendar-StyleSystem.html.

  The following sections appear below:
    Section A - basic, required elements that affect WebCalendar as a whole
    Section B - more specific to select areas of WebCalendar, yet still 
      affects many areas of WebCalendar
    Section C - classes specific to certain pages, but that affect either 
      the page as a whole, or large areas within that page
    Section D - the "nitty gritty" of classes. Used specifically for 
      fine-tuning elements within a specific page
*/

/* SECTION A */
?>body {
  color: <?php echo $GLOBALS['TEXTCOLOR']; ?>;
  font-family: <?php echo $GLOBALS['FONTS']; ?>;
  font-size: 12px;
  background-color: <?php echo $GLOBALS['BGCOLOR']; ?>;
}
<?php //links that don't have a specific class
//NOTE: these must appear ABOVE the 'printer' & all other 
//link-related classes for those classes to work 
?>a {
  color: <?php echo $GLOBALS['TEXTCOLOR']; ?>;
  text-decoration: none;
}
a:hover {
  color: #0000FF;
}
#edituser,
#edituserhandler,
#tabscontent {
  margin: 0px;
  padding: 0.5em;
  border: 2px groove #C0C0C0;
  width: 70%;
  background-color: #F8F8FF;
}
.tabfor {
  padding: 0.2em 0.2em 0.07em 0.2em;
  margin: 0px 0.2em 0px 0.8em;
  border-top: 2px ridge #C0C0C0;
  border-left: 2px ridge #C0C0C0;
  border-right: 2px ridge #C0C0C0;
  border-bottom: 2px solid #F8F8FF;
  background-color: #F8F8FF;
  font-size: 14px;
  text-decoration: none;
  color: #000000;
}
.tabbak {
  padding: 0.2em 0.2em 0px 0.2em;
  margin: 0 0.2em 0 0.8em;
  border-top: 2px ridge #C0C0C0;
  border-left: 2px ridge #C0C0C0;
  border-right: 2px ridge #C0C0C0;
  background-color: #E0E0E0;
  font-size: 14px;
  text-decoration: none;
  color: #000000;
}
#tabscontent_public,
#tabscontent_buddies,
#tabscontent_users,
#tabscontent_other,
#tabscontent_email,
#tabscontent_colors,
#tabscontent_participants,
#tabscontent_sched,
#tabscontent_pete,
#tabscontent_add,
#tabscontent_show,
#useriframe {
 display: none;
}
#tabscontent_buddies .buttonlist li {
 padding: 3px;
}
label {
  font-weight: bold;
}
.sample {
  border-style: groove;
}
<?php //transparent images used for visual color-selection
?>img.color {
  border-width: 0px;
  width: 15px;
  height: 15px;
}
<?php //display:none; is unhidden by includes/print_styles.css for printer-friendly pages 
?>#cat {
  display: none;
  font-size: 18px;
}
#trailer {
  margin: 0px;
  margin-top: 10px;
  padding-top: 5px;
}
#monthnav form {
  border-top: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  text-align: center;
  float: left;
  width: 50%;
  padding-top: 5px;
  margin-top: 5px;
  margin-bottom: 25px;
}
#monthnav label {
  margin: 0px;
  padding: 0px;
  font-weight: bold;
}
#monthnav #arrow {
  float: left;
  width: 50%;
}
#monthform {
  clear: left;
}
#weekform {
  text-align: center;
}
#yearform {
  text-align: right;
  clear: right;
}
#menu {
  clear: both;
}
#menu a {
  font-size: 14px;
  color: <?php echo $GLOBALS['TEXTCOLOR']; ?>;
  text-decoration: none;
}
#menu a:hover {
  color: #0000FF;
}
.prefix {
  font-weight: bold;
  font-size: 14px;
}
<?php //link to webcalendar site -- NOTE: by modifying this style, you can make this link disappear
?>a#programname {
  margin-top: 10px;
  font-size: 10px;
}
<?php //new event icon (i.e. '+' symbol)
?>.new {
  border-width: 0px;
  float: right;
}
<?php //links to entries/events
?>.entry {
  font-size: 13px;
  color: #006000;
  text-decoration: none;
  padding-right: 3px;
}
<?php //links to entries/events for which one is signed up for
?>.participating_entry {
  font-size: 13px;
  font-weight: bold;
  color: #600000;
  text-decoration: none;
  padding-right: 3px;
}
<?php //event (or bullet) icon; NOTE: must appear AFTER the .entry class
?>.entry img {
  border-width: 0px;
  margin-left: 2px;
  margin-right: 2px;
}
<?php //numerical date links in main calendars
?>.dayofmonth {
  font-size: 13px;
  color: #000000;
  font-weight: bold;
  text-decoration: none;
  border-top-width: 0px;
  border-left-width: 0px;
  border-right: 1px solid #888888;
  border-bottom: 1px solid #888888;
  padding: 0px 2px 0px 3px;
}
<?php //numerical date links in main calendars on hover
?>.dayofmonth:hover {
  color: #0000FF;
  border-right: 1px solid #0000FF;
  border-bottom: 1px solid #0000FF;
}
<?php //left arrow images
?>.prev img {
  border-width: 0px;
  margin-left: 3px;
  margin-top: 7px;
  float: left;
}
<?php //right arrow images
?>.next img {
  border-width: 0px;
  margin-right: 3px;
  margin-top: 7px;
  float: right;
}
#activitylog .prev {
  border-width: 0px;
  float: left;
}
#activitylog .next {
  border-width: 0px;
  float: right;
}
.nav {
  font-size: 14px;
  color: <?php echo $GLOBALS['TEXTCOLOR']; ?>;
  text-decoration: none;
}
.popup {
  font-size: 12px;
  color: <?php echo $GLOBALS['POPUP_FG']; ?>;
  <?php echo background_css ( $GLOBALS['POPUP_BG'], 200 ); ?>
  text-decoration: none;
  position: absolute;
  z-index: 20;
  visibility: hidden;
  top: 0px;
  left: 0px;
  border: 1px solid <?php echo $GLOBALS['POPUP_FG']; ?>;
  padding: 3px;
}
.popup dl {
  margin: 0px;
  padding: 0px;
}
.popup dt {
  font-weight: bold;
  margin: 0px;
  padding: 0px;
}
.popup dd {
  margin-left: 20px;
}
.tooltip {
  cursor: help;
  text-decoration: none;
  font-weight: bold;
}
.tooltipselect {
  cursor: help;
  text-decoration: none;
  font-weight: bold;
  vertical-align: top;
}
h2 {
  font-size: 20px;
  color: <?php echo $GLOBALS['H2COLOR']; ?>;
}
h3 {
  font-size: 18px;
}
p,
input,
select {
  font-size: 12px;
}
textarea {
  font-size: 12px;
  overflow: auto;
}
.user {
  font-size: 18px;
  color: <?php echo $GLOBALS['H2COLOR']; ?>;
  text-align: center;
}
<?php //left column in help sections 
?>.help {
  vertical-align: top;
  font-weight: bold;
}
<?php //question mark img linking to help sections
?>img.help {
  border-width: 0px;
  cursor: help;
}
<?php //standard table appearing mainly in prefs.php & admin.php 
?>.standard {
  border: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  background-color: <?php echo $GLOBALS['CELLBG']; ?>;
  font-size: 12px;
}
.standard th {
  color: <?php echo $GLOBALS['THFG']; ?>;
  <?php echo background_css ( $GLOBALS['THBG'], 30 ); ?>
  font-size: 18px;
  padding: 0px;
  border-bottom: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
}
<?php // printer-friendly tables for meal summary sheet
?>.printer {
 border: 1px solid #FF0000;
 font-size: 12px;
 display: block;
 text-decoration: none;
 clear: both;
}
.printer tr.light_border {
  border-top: 5px solid #00FF00;
}
<?php //Styles for minicalendars
      //keep font-size:12px for IE6
?>.minical {
  font-size: 12px;
  border-collapse: collapse;
  margin: 0px 0px 5px 0px;
}
.minical caption a {
  font-weight: bold;
  color: #B04040;
}
.minical caption a:hover {
  color: #0000FF;
}
<?php //formats the day name (i.e. Sun, Mon, etc) in minicals
?>.minical th, 
.minical td.empty {
  color: <?php echo $GLOBALS['TEXTCOLOR']; ?>;
  text-align: center;
  background-color: <?php echo $GLOBALS['BGCOLOR']; ?>;
}
.minical td {
  padding: 0px 2px;
  border: 1px solid <?php echo $GLOBALS['BGCOLOR']; ?>;
}
.minical td a {
  display: block;
  text-align: center;
  margin: 0px;
  padding: 3px;
}
.minical td.weekend {
  background-color: <?php echo $GLOBALS['WEEKENDBG']; ?>;
}
.minical td#today {
  background-color: <?php echo $GLOBALS['TODAYCELLBG']; ?>;
}
.minical td.hasevents {
  background-color: #DDDDFF;
  font-weight: bold;
}
<?php //Styles for the heart subscription minicalendar
      //keep font-size:12px for IE6
?>.heartsubcal {
  font-size: 12px;
  border-collapse: collapse;
  margin: 15px 15px 15px 15px;
}
<?php //formats the day name (i.e. Sun, Mon, etc) in heartsubcals
?>.heartsubcal th, 
.heartsubcal td.empty {
  color: #000000;
  text-align: center;
  background-color: #FFFFFF;
}
.heartsubcal td {
  padding: 0px 2px;
  border: 1px solid #444444;
}
#activitylog table,
.embactlog {
  width: 100%;
  border-bottom: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  border-right: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  border-spacing: 0px;
}
#activitylog tr,
.embactlog tr {
  background-color: #FFFFFF;
}
#activitylog .odd,
.embactlog .odd {
  background-color: #EEEEEE;
}
#activitylog th,
.embactlog th {
  width: 14%;
  color: <?php echo $GLOBALS['THFG']; ?>;
  background-color: <?php echo $GLOBALS['THBG']; ?>;
  border-top: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  border-left: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  border-bottom: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  padding: 1px 3px;
}
#activitylog th.usr,
.embactlog th.usr,
#activitylog th.cal,
.embactlog th.cal,
#activitylog th.action,
.embactlog th.action {
  width: 7%;
}
#activitylog td,
.embactlog td {
  border-left: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  padding: 1px 3px;
}
#month .main {
  border-bottom: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  border-right: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  width: 100%;
  clear: both;
}
<?php //contains ALL months
?>#year .main tr {
  vertical-align: top;
}
th {
  font-size: 13px;
  color: <?php echo $GLOBALS['THFG']; ?>;
  background-color: <?php echo $GLOBALS['THBG']; ?>;
}  
#month .main th {
  border-top: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  border-left: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  <?php echo background_css ( $GLOBALS['THBG'], 15 ); ?>
  width: 14%;
}
#year .main td {
  text-align: center;
  padding: 0px 3px;
}
#viewl .main td,
#month .main td {
  font-size: 12px;
  height: 75px;
  border-top: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  border-left: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  <?php echo background_css ( $GLOBALS['CELLBG'], 100 ); ?>
  vertical-align: top;
}
#month .main td.weekend {
  <?php echo background_css ( $GLOBALS['WEEKENDBG'], 100 ); ?>
  border-top: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  border-left: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
}
#month .main td.today {
  <?php echo background_css ( $GLOBALS['TODAYCELLBG'], 100 ); ?>
  border-top: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  border-left: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  vertical-align: top;
}
#month #prevmonth {
  float: left;
}
#month #nextmonth {
  float: right;
}
#month .minical caption {
  margin-left: 4ex;
}
<?php //keep font-size:12px; for IE6 rendering
      //display: block; keeps the caption vertically close to the day names
?>#year .minical {
  margin: 5px auto;
  display: block;
}
#year .minical caption {
  margin: 0px auto;
}
#viewl .minical,
#month .minical {
  border-width: 0px;
}
.title {
  width: 99%;
  text-align: center;
}
.title .viewname,
#day .title .user,
.title .user {
  font-size: 18px;
  font-weight: bold;
  color: <?php echo $GLOBALS['H2COLOR']; ?>;
  text-align: center;
}
#login {
  margin-top: 70px;
  margin-bottom: 50px;
  text-align: center;
}
#login table {
  border: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
  <?php echo background_css ( $GLOBALS['CELLBG'], 200 ); ?>
  font-size: 12px;
}
.bordered_table {
  border: 1px solid #000000;
  border-collapse: collapse;
}
.bordered_table td {
  border: 1px solid #000000;
  padding: 2px;
}
.bordered_table td.number {
  text-align: center;
  border: 1px solid #000000;
  padding: 2px;
  padding-left: 20px;
  padding-right: 20px;
}
.cookies {
  font-size: 13px;
}
.standard th {
  color: <?php echo $GLOBALS['THFG']; ?>;
  <?php echo background_css ( $GLOBALS['THBG'], 100 ); ?>
  font-size: 18px;
  padding: 0px;
  border-bottom: 1px solid <?php echo $GLOBALS['TABLEBG']; ?>;
}
abbr {
  cursor: help;
}
.addbutton {
  padding: 1px;
  width: 200px;
  text-align: center;
  background-color: #CCCCCC;
  border-top: 1px solid #EEEEEE;
  border-left: 1px solid #EEEEEE;
  border-bottom: 1px solid #777777;
  border-right: 1px solid #777777;
}
tr.d0 td {
  background-color: #FFFFFF;
  padding: 3px;
  padding-right: 15px;
}
tr.d1 td {
  background-color: #EEEEEE;
  padding: 3px;
  padding-right: 15px;
}
-->
</style>
