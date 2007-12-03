<?php

$pdf = pdf_new();
pdf_open_file($pdf, "philosophy.pdf");
pdf_begin_page($pdf, 595, 842);
$arial = pdf_findfont($pdf, "Arial", "host", 1); 
pdf_setfont($pdf, $arial, 10);
pdf_show_xy($pdf, "There are more things in heaven and earth, Horatio,", 50, 750); 
pdf_show_xy($pdf, "than are dreamt of in your philosophy", 50, 730);
pdf_end_page($pdf);
pdf_close($pdf);

?>
