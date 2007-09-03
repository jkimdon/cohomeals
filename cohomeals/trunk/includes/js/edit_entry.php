<?php
	global $groups_enabled,$WORK_DAY_START_HOUR,$WORK_DAY_END_HOUR;
?><script type="text/javascript">
<!-- <![CDATA[
// do a little form verifying
function validate_and_submit () {

  // Leading zeros seem to confuse parseInt()
  if ( document.editentryform.hour.value.charAt ( 0 ) == '0' )
    document.editentryform.hour.value = document.editentryform.hour.value.substring ( 1, 2 );
  h = parseInt ( document.editentryform.hour.value );
  m = parseInt ( document.editentryform.minute.value );
  <?php if ($GLOBALS["TIME_FORMAT"] == "12") { ?>
    if ( document.editentryform.ampm[1].checked ) {
      // pm
      if ( h < 12 )
        h += 12;
    } else {
      // am
      if ( h == 12 )
        h = 0;
    }
  <?php } ?>
  if ( h >= 24 || m > 59 || !h ) {
    alert ( "You have not entered a valid time of day" );
    document.editentryform.hour.select ();
    document.editentryform.hour.focus ();
    return false;
  }


  // make sure at least one weekday has been checked 
  if ( document.editentryform.repeats.value == "true" ) {
    dayok = false;
    if ( document.editentryform.onSun.checked == true ) dayok = true;
    if ( document.editentryform.onMon.checked == true ) dayok = true;
    if ( document.editentryform.onTue.checked == true ) dayok = true;
    if ( document.editentryform.onWed.checked == true ) dayok = true;
    if ( document.editentryform.onThurs.checked == true ) dayok = true;
    if ( document.editentryform.onFri.checked == true ) dayok = true;
    if ( document.editentryform.onSat.checked == true ) dayok = true;
    if ( dayok == false ) {
      alert ( "You have not entered a day of the week." );
      return false;
    }
  }

  //Add code to make HTMLArea code stick in TEXTAREA
  if (typeof editor != "undefined") editor._textArea.value = editor.getHTML();
  // would be nice to also check date to not allow Feb 31, etc...

  document.editentryform.submit ();
  return true;
}

function selectDate (  day, month, year, current, evt ) {
  // get currently selected day/month/year
  monthobj = eval ( 'document.editentryform.' + month );
  curmonth = monthobj.options[monthobj.selectedIndex].value;
  yearobj = eval ( 'document.editentryform.' + year );
  curyear = yearobj.options[yearobj.selectedIndex].value;
  date = curyear;

		if (document.getElementById) {
    mX = evt.clientX   + 40;
    mY = evt.clientY  + 120;
  }
  else {
    mX = evt.pageX + 40;
    mY = evt.pageY +130;
  }
	var MyPosition = 'scrollbars=no,toolbar=no,left=' + mX + ',top=' + mY + ',screenx=' + mX + ',screeny=' + mY ;
  if ( curmonth < 10 )
    date += "0";
  date += curmonth;
  date += "01";
  url = "datesel.php?form=editentryform&fday=" + day +
    "&fmonth=" + month + "&fyear=" + year + "&date=" + date;
  var colorWindow = window.open(url,"DateSelection","width=300,height=200,"  + MyPosition);
}

<?php if ( $groups_enabled == "Y" ) { 
?>function selectUsers () {
  // find id of user selection object
  var listid = 0;
  for ( i = 0; i < document.editentryform.elements.length; i++ ) {
    if ( document.editentryform.elements[i].name == "participants[]" )
      listid = i;
  }
  url = "usersel.php?form=editentryform&listid=" + listid + "&users=";
  // add currently selected users
  for ( i = 0, j = 0; i < document.editentryform.elements[listid].length; i++ ) {
    if ( document.editentryform.elements[listid].options[i].selected ) {
      if ( j != 0 )
	       url += ",";
      j++;
      url += document.editentryform.elements[listid].options[i].value;
    }
  }
  //alert ( "URL: " + url );
  // open window
  window.open ( url, "UserSelection",
    "width=500,height=500,resizable=yes,scrollbars=yes" );
}
<?php } ?>


function suittype_handler() {
  var i = document.editentryform.suit.selectedIndex;
  var val = document.editentryform.suit.options[i].text;

  if ( (val == "heart") || (val == "club") || (val == "diamond") ) {
    makeVisible ( "suitenddate" );
    document.editentryform.repeats.value = "true";
  } else {
    makeInvisible( "suitenddate" );
    document.editentryform.repeats.value = "false";
  }

  if ( (val == "heart") || (val == "club") ) {
    makeVisible ( "suitdayofweek" );
    makeInvisible( "menubox" );
    makeInvisible( "headchef" );
  } else {
    makeInvisible( "suitdayofweek" );
    makeVisible( "menubox" );
    makeVisible( "headchef" );
  }

  if ( (val == "diamond" ) ) {
    document.editentryform.onSun.checked = true;

    document.editentryform.onMon.checked = false;
    document.editentryform.onTue.checked = false;
    document.editentryform.onWed.checked = false;
    document.editentryform.onThurs.checked = false;
    document.editentryform.onFri.checked = false;
    document.editentryform.onSat.checked = false;
  }
  else {
    document.editentryform.onSun.checked = false;
    document.editentryform.onMon.checked = false;
    document.editentryform.onTue.checked = false;
    document.editentryform.onWed.checked = false;
    document.editentryform.onThurs.checked = false;
    document.editentryform.onFri.checked = false;
    document.editentryform.onSat.checked = false;
  }
}



<?php //see the showTab function in includes/js/visible.php for common code shared by all pages
	//using the tabbed GUI.
?>
var tabs = new Array();
tabs[0] = "details";
tabs[1] = "participants";
tabs[2] = "pete";

var sch_win;

function getUserList () {
  var listid = 0;
  for ( i = 0; i < document.editentryform.elements.length; i++ ) {
    if ( document.editentryform.elements[i].name == "participants[]" )
      listid = i;
  }
  return listid;
}

//]]> -->
</script>
