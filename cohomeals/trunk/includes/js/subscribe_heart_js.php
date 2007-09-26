<?php
	global $groups_enabled,$WORK_DAY_START_HOUR,$WORK_DAY_END_HOUR;
?><script type="text/javascript">
<!-- <![CDATA[

function subtype_handler() {
  var i = document.subheartform.subtype.selectedIndex;
  var val = document.subheartform.subtype.options[i].value;

  if ( val == "ongoing" ) {
    makeVisible ( "ongoingcues" );
  } else {
    makeInvisible ( "ongoingcues" );
  }

  if ( val == "limited" ) {
    makeVisible ( "limitedcues" );
  } else {
    makeInvisible ( "limitedcues" );
  }

}



function check_time_period() {

  obj = document.subheartform;

  var start_day = parseInt( obj.substartday.options[obj.substartday.selectedIndex].value );
  var start_month = parseInt( obj.substartmonth.options[obj.substartmonth.selectedIndex].value );
  var start_year = parseInt( obj.substartyear.options[obj.substartyear.selectedIndex].value );

  var end_day = parseInt ( obj.subendday.options[obj.subendday.selectedIndex].value );
  var end_month = parseInt ( obj.subendmonth.options[obj.subendmonth.selectedIndex].value );
  var end_year = parseInt ( obj.subendyear.options[obj.subendyear.selectedIndex].value );

  var end_day_count = (end_year - start_year) * 365 + end_month * 30 + end_day;
  var start_day_count = start_month * 30 + start_day;
  var diff_days = end_day_count - start_day_count + 1;

  if ( diff_days < 90 ) {
    alert ( "You must commit to at least three months of heart meals." );
    return false;
  }

  url = "limited_heart.php?startday=" + start_day + "&startmonth=" + start_month + 
    "&startyear=" + start_year + "&endday=" + end_day + "&endmonth=" + end_month +
    "&endyear=" + end_year;
  window.open ( url, "Select dates", "width=300,height=600,resizable=yes,scrollbars=yes" );
}



function check_number_meals( minid, maxid, count ) {
  
  num_checked = 0;
  cutoff = 0.66 * parseFloat( count );

  for ( i = minid; i < maxid; i++ ) {
    is_checked = eval ( 'document.limitedheartform.d' + i + '.checked' );
    if ( is_checked == true ) 
      num_checked++;
  }

  if ( parseFloat( num_checked ) < cutoff ) {
    alert ( "You must commit to at least 2/3 of the dates to obtain the volume discount." );
    return false;
  }

  document.limitedheartform.submit ();
  return true;
}



function selectDate (  day, month, year, current, evt ) {
  // get currently selected day/month/year
  monthobj = eval ( 'document.subheartform.' + month );
  curmonth = monthobj.options[monthobj.selectedIndex].value;
  yearobj = eval ( 'document.subheartform.' + year );
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
  url = "datesel.php?form=subheartform&fday=" + day +
    "&fmonth=" + month + "&fyear=" + year + "&date=" + date;
  var colorWindow = window.open(url,"DateSelection","width=300,height=200,"  + MyPosition);
}

<?php if ( $groups_enabled == "Y" ) { 
?>function selectUsers () {
  // find id of user selection object
  var listid = 0;
  for ( i = 0; i < document.subheartform.elements.length; i++ ) {
    if ( document.subheartform.elements[i].name == "participants[]" )
      listid = i;
  }
  url = "usersel.php?form=subheartform&listid=" + listid + "&users=";
  // add currently selected users
  for ( i = 0, j = 0; i < document.subheartform.elements[listid].length; i++ ) {
    if ( document.subheartform.elements[listid].options[i].selected ) {
      if ( j != 0 )
	       url += ",";
      j++;
      url += document.subheartform.elements[listid].options[i].value;
    }
  }
  //alert ( "URL: " + url );
  // open window
  window.open ( url, "UserSelection",
    "width=500,height=500,resizable=yes,scrollbars=yes" );
}
<?php } ?>


//]]> -->
</script>
