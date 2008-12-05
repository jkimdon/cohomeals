<?php
include_once 'includes/init.php';
require('fpdf/fpdf.php');


/////
class PDF extends FPDF {

function MyHeader() {
  $this->SetFont('Times','B',12);
  $this->Cell(65); // move to center-ish
  $today = date( "Ymd" );
  $text = "Pantry price list";
  $this->Cell( 50,6, $text, 1,1, 'C' );

  $this->SetFont('Times','',10);
  $this->Cell(65);
  $text = "Last updated " . date_to_str( $today, "", true, true );
  $this->Cell( 50,4, $text, 0,1, 'C' );

  $this->Cell(65);
  $text = "Key: O = organic, L = local, S = spray-free, D = direct from grower";
  $this->Cell( 50,4, $text, 0,1, 'C' );

  $this->Cell(65);
  $text = "* = NOT available for purchase by households";
  $this->Cell( 50,4, $text, 0,1, 'C' );
  
}


function PrintFoods() {
  $height = 5;

  $sql = "SELECT cal_category, cal_description, cal_unit, cal_unit_price, " .
    "cal_flags, cal_available_individuals " .
    "FROM webcal_pantry_food WHERE cal_available_meals = 1 AND cal_category != '__special' " .
    "ORDER BY cal_category, cal_description";
  $prev_category = "";
  $color = true;
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $cat = $row[0];
      $desc = $row[1];
      $unit = $row[2];
      $price = $row[3];
      $flags = $row[4];
      $indiv = $row[5];

      if ( $prev_category != $cat ) {
	$text = $cat . ":";
	$this->SetFont('Times','B',10);
	$this->Cell( 20,$height, $text, 0,1, 'L' );
	$prev_category = $cat;
      }

      if ( $color == true ) {
	$this->SetFillColor( 230,230,230 );
	$color = false;
      } else {
	$this->SetFillColor( 255,255,255 );
	$color = true;
      }

      $this->SetFont('Times','',10);
      $this->Cell(10);
      $text = $desc;
      if ( $indiv == 0 ) $text .= "*";
      if ( $flags != "" ) $text .= "  (" . $flags . ")";
      $this->Cell( 130,$height, $text, 0,0, 'L', 1 );

      $text = price_to_str( $price ) . " / " . $unit;
      $this->Cell( 30,$height, $text, 0,1, 'L', 1 );

    }
  }

}

} /// end class



//// make the sheet

$pdf = new PDF();
$pdf->AddPage();
$pdf->MyHeader();
$pdf->PrintFoods();


$pdf->Output( "pantryPrices.pdf", 'I' );



?>


