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
  if ( document.editentryform.repeats.value == true ) {
    dayok = false;
    if ( document.editentryform.d0.checked == true ) dayok = true;
    if ( document.editentryform.d1.checked == true ) dayok = true;
    if ( document.editentryform.d2.checked == true ) dayok = true;
    if ( document.editentryform.d3.checked == true ) dayok = true;
    if ( document.editentryform.d4.checked == true ) dayok = true;
    if ( document.editentryform.d5.checked == true ) dayok = true;
    if ( document.editentryform.d6.checked == true ) dayok = true;
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
  var colorWindow = window.open(url,"DateSelection","width=280,height=280,"  + MyPosition);
}



function suittype_handler() {
  var i = document.editentryform.suit.selectedIndex;
  var val = document.editentryform.suit.options[i].text;

  if ( (val == "heart") || (val == "club") || (val == "diamond") ) {
    makeVisible ( "suitenddate" );
    document.editentryform.repeats.value = "1";
    document.editentryform.uses_endday.value = "1";
  } else {
    makeInvisible( "suitenddate" );
    document.editentryform.repeats.value = "";
    document.editentryform.uses_endday.value = "";
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

  if ( val == "heart" ) {
    makeInvisible ( "signup_deadline" );
  } else {
    makeVisible ( "signup_deadline" );
  }

  if ( val == "diamond" ) {
    document.editentryform.d0.checked = "1";

    document.editentryform.d1.checked = "";
    document.editentryform.d2.checked = "";
    document.editentryform.d3.checked = "";
    document.editentryform.d4.checked = "";
    document.editentryform.d5.checked = "";
    document.editentryform.d6.checked = "";

    document.editentryform.base_price.value = 300;
  }
  else {
    document.editentryform.d0.checked = "";
    document.editentryform.d1.checked = "";
    document.editentryform.d2.checked = "";
    document.editentryform.d3.checked = "";
    document.editentryform.d4.checked = "";
    document.editentryform.d5.checked = "";
    document.editentryform.d6.checked = "";

    document.editentryform.base_price.value = 400;    
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
