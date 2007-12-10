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
$sql = "SELECT cal_fullname, cal_host, cal_fee " .
       "FROM webcal_meal_guest " .
       "WHERE cal_meal_id = $id " . 
       "AND ( cal_type = 'M' OR cal_type = 'T' )";
if ( $res = dbi_query( $sql ) ) {
  while ( $row = dbi_fetch_row( $res ) ) {
    $guest_name = $row[0];
    $host = $row[1];
    $age = $row[2];
    user_load_variables( $host, "temp" );
    $guests[$guest_count]['cal_fullname'] = $guest_name;
    $guests[$guest_count]['cal_unit'] = $GLOBALS['tempunit'];
    $guests[$guest_count++]['cal_fee'] = $age;
  }
  dbi_free_result( $res );
}




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
  $this->MultiCell( 120,5, $text );

  $text = "Price: " . price_to_str( $price );
  $this->Cell( 40, 5, $text, 0,0, 'L' );
  $this->Ln(4);

  $text = "Menu: " . $menu;
  $this->MultiCell( 120,5, $text );

  $this->Ln(4);
}

function PrintLabels( $horiz_offset ) {
  $this->SetFillColor(200,200,200);
  $height = 5;

  $this->Cell( $horiz_offset );

  $this->Cell( 5,$height, "D", 1, 0, 'C', 1 );
  $this->Cell( 5,$height, "W", 1, 0, 'C', 1 );
  $this->Cell( 8,$height, "Unit", 1, 0, 'C', 1 );
  $this->Cell( 37,$height, "Name", 1, 0, 'C', 1 );
  $this->Cell( 5,$height, "A", 1, 0, 'C', 1 );
  $this->Cell( 5,$height, "L", 1, 0, 'C', 1 );
  $this->Ln();
}


function Building( $label, $horiz_offset ) {
  $this->SetFillColor( 230,230,230 );
  $this->Cell( $horiz_offset );
  $this->Cell( 65,4, $label, 1, 1, 'C', 1 );
}


function DinerTable( $names, $event_date, $id ) {

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
	$horiz_offset = 80;
	$this->SetY( $top );
	$this->PrintLabels( $horiz_offset );
      }
      if ( ($building <= 9) && ($building > 0) ) 
	$label = "Building " . $building;
      else 
	$label = "Friends";
      $this->Building( $label, $horiz_offset );
    $prev_building = $building;
  }
  if ( is_dining( $id, $username ) ) 
    $dining = "X";
  else 
    $dining = "";
  if ( is_walkin( $id, $username ) )
    $walkin = "X";
  else $walkin = "";
  $this->Cell( $horiz_offset );
  $this->Cell( 5,$height, $dining, 1, 0, 'C', $fill );
  $this->Cell( 5,$height, $walkin, 1, 0, 'C', $fill );
  $this->Cell( 8,$height, $name['cal_unit'], 1, 0, 'C', $fill );
  $this->Cell( 37,$height, $name['cal_fullname'], 1, 0, 'L', $fill );
  $this->Cell( 5,$height, get_fee_category( $name['cal_birthdate'], $event_date ), 
	       1, 0, 'C', $fill );
  $this->Cell( 5,$height, "", 1, 0, 'C', $fill ); // leftovers
  $this->Ln();

  }

}


function AddGuests( $guests ) {

  $horiz_offset = 80;
  $height = 4;
  $this->Building( "Guests", $horiz_offset );
  foreach( $guests as $guest ) {
    $fullname = html_entity_decode( $guest['cal_fullname'], ENT_QUOTES );
    $host_unit = $guest['cal_unit'];
    $age = $guest['cal_fee'];
    $this->Cell( $horiz_offset );
    $this->Cell( 5,$height, "X", 1, 0, 'C' );
    $this->Cell( 5,$height, $walkin, 1, 0, 'C' );
    $this->Cell( 8,$height, $host_unit, 1, 0, 'C' );
    $this->Cell( 37,$height, $fullname, 1, 0, 'L' );
    $this->Cell( 5,$height, $age, 1, 0, 'C' );
    $this->Cell( 5,$height, "", 1, 0, 'C' ); // leftovers
    $this->Ln();

  }


  // put in slots for walkin guests
  $this->Cell( $horiz_offset );
  $this->Cell( 65, $height, "Enter host's unit number for additional guests", 
	       'RL',1,'C');
  for ( $i=0; $i<5; $i++ ) {
    $this->Cell( $horiz_offset );
    $this->Cell( 5,$height, "", 1, 0, 'C' ); // not pre-signed up
    $this->Cell( 5,$height, "", 1, 0, 'C' );
    $this->Cell( 8,$height, "", 1, 0, 'C' );
    $this->Cell( 37,$height, "", 1, 0, 'L' );
    $this->Cell( 5,$height, "", 1, 0, 'C' );
    $this->Cell( 5,$height, "", 1, 0, 'C' ); // leftovers
    $this->Ln();
  }

}


}

/////



//// make the sheet

$pdf=new PDF();
$pdf->AddPage();
$pdf->MyHeader( $event_date, $event_time );

$pdf->SetFont('Times','',10);
$pdf->MealInfo( $head_chef, $crew, $menu, $price );

$names = user_get_users();
$pdf->DinerTable( $names, $event_date, $id );
$pdf->AddGuests( $guests );

$pdf->Output( "signupSheet.pdf", 'I' );



?>


