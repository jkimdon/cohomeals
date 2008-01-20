<?php
include_once 'includes/init.php';
require('fpdf/fpdf.php');

$id = mysql_safe( getValue( 'id' ), false );
if ( empty ( $id ) || $id <= 0 || ! is_numeric ( $id ) ) {
  $error = translate ( "Invalid entry id" ) . "."; 
}


//// load meal date/time/price
$event_date = 0;
$event_time = 0;
$menu = "";
$price = 0;
$sql = "SELECT cal_date, cal_time, cal_menu, cal_base_price " .
 "FROM webcal_meal " .
 "WHERE cal_id = $id";
if ( $res = dbi_query( $sql ) ) {
  if ( $row = dbi_fetch_row( $res ) ) {
    $event_date = $row[0];
    $event_time = $row[1];
    $menu = $row[2];
    $price = $row[3];
  }
  dbi_free_result( $res );
} else {
  echo "error<br>";
  exit;
}


/// load head chef
$head_chef = "";
$sql = "SELECT cal_login " .
 "FROM webcal_meal_participant " .
 "WHERE cal_id = $id AND cal_type = 'H'";
if ( $res = dbi_query( $sql ) ) {
  if ( $row = dbi_fetch_row( $res ) ) {
    $user = $row[0];
    user_load_variables( $user, "temp" );
    $head_chef = $GLOBALS['tempfullname'];
  }
  dbi_free_result( $res );
}


//// load crew
$crew = array();
$count = 0;
$sql = "SELECT cal_login " .
 "FROM webcal_meal_participant " .
 "WHERE cal_id = $id AND cal_type = 'C'";
if ( $res = dbi_query( $sql ) ) {
  while ( $row = dbi_fetch_row( $res ) ) {
    $user = $row[0];
    user_load_variables( $user, "temp" );
    $crew[$count++] = $GLOBALS['tempfullname'];
  }
  dbi_free_result( $res );
}


//// load guests
$guests = array();
$guest_count = 0;
$sql = "SELECT cal_fullname, cal_host, cal_fee, cal_type " .
       "FROM webcal_meal_guest " .
       "WHERE cal_meal_id = $id " . 
       "AND ( cal_type = 'M' OR cal_type = 'T' ) " .
       "ORDER BY cal_host, cal_fullname";
if ( $res = dbi_query( $sql ) ) {
  while ( $row = dbi_fetch_row( $res ) ) {
    $guest_name = $row[0];
    $host = $row[1];
    $age = $row[2];
    if ( $row[3] == "T" ) $takehome = "T";
    else $takehome = "";
    user_load_variables( $host, "temp" );
    $guests[$guest_count]['cal_fullname'] = $guest_name;
    $guests[$guest_count]['cal_unit'] = $GLOBALS['tempunit'];
    $guests[$guest_count]['cal_fee'] = $age;
    $guests[$guest_count++]['takehome'] = $takehome;
  }
  dbi_free_result( $res );
}


$counts = array();
$counts['dining_adult'] = 0;
$counts['dining_kid'] = 0;
$counts['dining_free'] = 0;
$counts['sub_adult'] = 0;
$counts['sub_kid'] = 0;
$counts['sub_free'] = 0;
$counts['walkin_adult'] = 0;
$counts['walkin_kid'] = 0;
$counts['walkin_free'] = 0;
$counts['all'] = 0;



////// pdf classes for signup sheet

class PDF extends FPDF {

function MyHeader( $date, $time ) {
  $this->SetFont('Times','B',12);
  $this->Cell(65); // move to center-ish
  $text = "Meal sign-up sheet for the meal on " . 
    date_to_str( $date, "", true, true ) . " at " .
    display_time( $time );
  $this->Cell( 50,10, $text, 0,1, 'C' );
}

function MealInfo( $head_chef, $crew, $menu, $price ) {
  $text = "Lead: " . $head_chef;
  $this->Cell( 40,5, $text, 0,0, 'L' );
  $this->Ln( 4 );

  $text = "Crew: ";
  for( $i=0; $i<count($crew); $i++ ) {
    $text .= $crew[$i] . ", ";
  }
  $this->MultiCell( 180,5, $text );

  $text = "Base price: " . price_to_str( $price );
  $this->Cell( 40, 5, $text, 0,0, 'L' );
  $this->Ln(4);

  $text = "Menu: " . $menu;
  $this->MultiCell( 180,5, $text );

  $this->Ln(4);
}

function PrintLabels( $horiz_offset ) {
  $this->SetFillColor(200,200,200);
  $height = 5;

  $this->Cell( $horiz_offset );

  $this->Cell( 5,$height, "R", 1, 0, 'C', 1 );
  $this->Cell( 5,$height, "T", 1, 0, 'C', 1 );
  $this->Cell( 8,$height, "Unit", 1, 0, 'C', 1 );
  $this->Cell( 37,$height, "Name", 1, 0, 'C', 1 );
  $this->Cell( 5,$height, "P", 1, 0, 'C', 1 );
  $this->Cell( 10,$height, "L", 1, 0, 'C', 1 );
  $this->Ln();
}


function PrintLegend() {
  $saveX = $this->GetX();
  $saveY = $this->GetY();

  $horiz_offset = 148;
  $height = 4;
  $this->SetX( 10 );

  $total_width = 45;
  $space_width = 8;
  $remaining_width = 37;

  $this->SetFillColor( 230,230,230 );
  $this->Cell( $horiz_offset );
  $this->Cell( $total_width, $height, "Legend", 1,1,'C',1 );

  $this->Cell( $horiz_offset );
  $this->Cell( $total_width, $height, "R = Reservation status", 1,1,'L');
  $this->Cell( $horiz_offset );
  $this->Cell( $space_width, $height, "", "LTB" );
  $this->Cell( $remaining_width, $height, "(X = regular)", "RTB",1,'L');
  $this->Cell( $horiz_offset );
  $this->Cell( $space_width, $height, "", "LTB" );
  $this->Cell( $remaining_width, $height, "(D = heart discount)", "RTB",1,'L');
  $this->Cell( $horiz_offset );
  $this->Cell( $space_width, $height, "", "LTB" );
  $this->Cell( $remaining_width, $height, "(G = guest)", "RTB",1,'L');
  $this->Cell( $horiz_offset );
  $this->Cell( $space_width, $height, "", "LTB" );
  $this->Cell( $remaining_width, $height, "(W = walkin)", "RTB",1,'L');

  $this->Cell( $horiz_offset );
  $this->Cell( $total_width, $height, "T = Take-home plate", 1,1,'L');

  $this->Cell( $horiz_offset );
  $this->Cell( $total_width, $height, "P = Price code", 1,1,'L');
  $this->Cell( $horiz_offset );
  $this->Cell( $space_width, $height, "", "LTB" );
  $this->Cell( $remaining_width, $height, "(A = adult)", "RTB",1,'L');
  $this->Cell( $horiz_offset );
  $this->Cell( $space_width, $height, "", "LTB" );
  $this->Cell( $remaining_width, $height, "(K = kid 4-12 yrs)", "RTB",1,'L');
  $this->Cell( $horiz_offset );
  $this->Cell( $space_width, $height, "", "LTB" );
  $this->Cell( $remaining_width, $height, "(F = free <4 yrs)", "RTB",1,'L');


  $this->Cell( $horiz_offset );
  $this->Cell( $total_width, $height, "L = Leftovers (write $ amount)", 1,1,'L');

  $this->SetX( $saveX );
  $this->SetY( $saveY );

}

function Building( $label, $horiz_offset ) {
  $this->SetFillColor( 230,230,230 );
  $this->Cell( $horiz_offset );
  $this->Cell( 70,4, $label, 1, 1, 'C', 1 );
}


function DinerTable( $names, $event_date, $id, &$counts ) {

  $top = $this->GetY();

  $this->PrintLabels( 1 );
  $this->SetFillColor(240,240,240);

  $fill = 0;
  $height = 4;
  $horiz_offset = 1;
  $prev_building = 0;
  foreach( $names as $name ) {
    $username = $name['cal_login'];
    $building = $name['cal_building'];
    if ( $building != $prev_building ) {
      if ( $building == 7 ) {
	$horiz_offset = 75;
	$this->SetY( $top );
	$this->PrintLabels( $horiz_offset );
      }
      if ( ($building <= 9) && ($building > 0) ) 
	$label = "Building " . $building;
      else 
	$label = "Additional meal plan participants";
      $this->Building( $label, $horiz_offset );
      $prev_building = $building;
    }
    
    // check dining status
    if ( $onsite = is_dining( $id, $username ) ) {
      if ( is_subscriber( $id, $username ) )  $dining = "D";
      else if ( is_walkin( $id, $username ) )  $dining = "W";
      else $dining = "X";
    }
    else 
      $dining = "";
    
    $takehome = "";
    if ( $onsite == "T" ) $takehome = "T";
    
    $age = get_fee_category( $name['cal_birthdate'], $event_date );
    
    $this->Cell( $horiz_offset );
    $this->Cell( 5,$height, $dining, 1, 0, 'C', $fill );
    $this->Cell( 5,$height, $takehome, 1, 0, 'C', $fill );
    $this->Cell( 8,$height, $name['cal_unit'], 1, 0, 'C', $fill );
    $this->Cell( 37,$height, $name['cal_fullname'], 1, 0, 'L', $fill );
    $this->Cell( 5,$height, $age, 1, 0, 'C', $fill );
    $this->Cell( 10,$height, "", 1, 0, 'C', $fill ); // leftovers
    $this->Ln();
    
    
    // update counts
    $label = "";
    if ( $dining != "" ) {
      if ( $dining == "W" ) 
	$label = "walkin";
      else {
	if ( $dining == "D" )
	  $label = "sub";
	else $label = "dining";
      }
      if ( $age == "A" ) 
	$label .= "_adult";
      else if ( $age == "F" )
	$label .= "_free";
      else $label .= "_kid";
      $counts['all']++;
      $counts[$label]++;
    }
    
  }

}


function AddGuests( $guests, &$counts ) {

  $horiz_offset = 75;
  $height = 4;
  $this->Building( "Guests", $horiz_offset );
  foreach( $guests as $guest ) {
    $fullname = html_entity_decode( $guest['cal_fullname'], ENT_QUOTES );
    $host_unit = $guest['cal_unit'];
    $age = $guest['cal_fee'];
    $takehome = $guest['takehome'];
    $this->Cell( $horiz_offset );
    $this->Cell( 5,$height, "G", 1, 0, 'C' );
    $this->Cell( 5,$height, $takehome, 1, 0, 'C' );
    $this->Cell( 8,$height, $host_unit, 1, 0, 'C' );
    $this->Cell( 37,$height, $fullname, 1, 0, 'L' );
    $this->Cell( 5,$height, $age, 1, 0, 'C' );
    $this->Cell( 10,$height, "", 1, 0, 'C' ); // leftovers
    $this->Ln();

    $counts['all']++;
  }


  // put in slots for walkin guests
  $this->Cell( $horiz_offset );
  $this->Cell( 70, $height, "Enter host's unit number for additional guests", 
	       'RL',1,'C');
  for ( $i=0; $i<5; $i++ ) {
    $this->Cell( $horiz_offset );
    $this->Cell( 5,$height, "", 1, 0, 'C' ); // not pre-signed up
    $this->Cell( 5,$height, "", 1, 0, 'C' ); // takehome
    $this->Cell( 8,$height, "", 1, 0, 'C' );
    $this->Cell( 37,$height, "", 1, 0, 'L' );
    $this->Cell( 5,$height, "", 1, 0, 'C' );
    $this->Cell( 10,$height, "", 1, 0, 'C' ); // leftovers
    $this->Ln();
  }

}

function SumTotals( $counts ) {

 $horiz_offset = 150;
 $height = 4;

 $this->SetY( 200 );

 $this->SetFillColor( 200,200,200 );
 $this->Cell( $horiz_offset );
 $this->Cell( 40, $height, "Totals", 1, 1, 'C', 1 );


 /// counts


 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Total reservations: ", 1, 0, 'L' );
 $this->Cell( 10, $height, $counts['all'], 1, 1, 'C' );


 $this->SetFillColor( 230,230,230 );
 $this->Cell( $horiz_offset );
 $this->Cell( 40, $height, "Regular price", 1, 1, 'L', 1 );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Adults", 1, 0, 'R' );
 $this->Cell( 10, $height, $counts['dining_adult'], 1, 1, 'C' );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Kids (4-12)", 1, 0, 'R' );
 $this->Cell( 10, $height, $counts['dining_kid'], 1, 1, 'C' );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Free (<4)", 1, 0, 'R' );
 $this->Cell( 10, $height, $counts['dining_free'], 1, 1, 'C' );

 $this->Cell( $horiz_offset );
 $this->Cell( 40, $height, "Heart discount", 1, 1, 'L', 1 );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Adults", 1, 0, 'R' );
 $this->Cell( 10, $height, $counts['sub_adult'], 1, 1, 'C' );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Kids (4-12)", 1, 0, 'R' );
 $this->Cell( 10, $height, $counts['sub_kid'], 1, 1, 'C' );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Free (<4)", 1, 0, 'R' );
 $this->Cell( 10, $height, $counts['sub_free'], 1, 1, 'C' );

 $this->Cell( $horiz_offset );
 $this->Cell( 40, $height, "Guests", 1, 1, 'L', 1 );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Adults", 1, 0, 'R' );
 $this->Cell( 10, $height, "", 1, 1, 'C' );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Kids (4-12)", 1, 0, 'R' );
 $this->Cell( 10, $height, "", 1, 1, 'C' );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Free (<4)", 1, 0, 'R' );
 $this->Cell( 10, $height, "", 1, 1, 'C' );

 $this->Cell( $horiz_offset );
 $this->Cell( 40, $height, "Walkins", 1, 1, 'L', 1 );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Adults", 1, 0, 'R' );
 $this->Cell( 10, $height, "", 1, 1, 'C' );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Kids (4-12)", 1, 0, 'R' );
 $this->Cell( 10, $height, "", 1, 1, 'C' );
 $this->Cell( $horiz_offset );
 $this->Cell( 30, $height, "Free (<4)", 1, 0, 'R' );
 $this->Cell( 10, $height, "", 1, 1, 'C' );


}

/////

}


//// make the sheet

$pdf=new PDF();
$pdf->AddPage();
$pdf->MyHeader( $event_date, $event_time );

$pdf->SetFont('Times','',10);
$pdf->MealInfo( $head_chef, $crew, $menu, $price );
$pdf->PrintLegend();

$names = user_get_users();
$pdf->DinerTable( $names, $event_date, $id, $counts );
$pdf->AddGuests( $guests, $counts );
$pdf->SumTotals( $counts );




$pdf->Output( "signupSheet.pdf", 'I' );



?>


