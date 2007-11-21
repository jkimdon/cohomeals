<?php

$startday = "";
$startday = mysql_safe( getGetValue( 'startday' ), false );
$startmonth = "";
$startmonth = mysql_safe( getGetValue( 'startmonth' ), false );
$startyear = "";
$startyear = mysql_safe( getGetValue( 'startyear' ), false );
if ( $startday == "" || $startmonth == "" || $startyear == "" )
  $startdate = "";
else 
  $startdate = sprintf ( "%04d%02d%02d", $startyear, $startmonth, $startday );

$endday = "";
$endday = mysql_safe( getGetValue( 'endday' ), false );
$endmonth = "";
$endmonth = mysql_safe( getGetValue( 'endmonth' ), false );
$endyear = "";
$endyear = mysql_safe( getGetValue( 'endyear' ), false );
if ( $endday == "" || $endmonth == "" || $endyear == "" )
  $enddate = "";
else 
  $enddate = sprintf ( "%04d%02d%02d", $endyear, $endmonth, $endday );

if ( ($enddate == "") || ($startdate == "") ) {
  $enddate = date( "Ymd" );
  $year = substr ( $enddate, 0, 4 );
  $month = substr ( $enddate, 4, 2 ) + 1;
  $day = substr ( $enddate, 6, 2 );
  $enddate = date( "Ymd", mktime ( 3, 0, 0, $month, $day, $year ) );
  $month = substr ( $enddate, 4, 2 ) - 2;
  $startdate = date( "Ymd", mktime ( 3, 0, 0, $month, $day, $year ) );
} else {
  $startdate = date( "Ymd", mktime ( 3,0,0, $startmonth, $startday, $startyear ) );
  $enddate = date( "Ymd", mktime ( 3,0,0, $endmonth, $endday, $endyear ) );
} 

?>
