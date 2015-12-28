<?php

$section = 'calendar';
require_once ('tiki-setup.php');

$jumpto = TikiLib::make_time(0,0,0, $_REQUEST['jumpto_Month'], 
			     $_REQUEST['jumpto_Day'],
			     $_REQUEST['jumpto_Year']);
$url = "tiki-calendar.php?todate=" . $jumpto;

header('location: tiki-calendar.php?todate=' . $jumpto);
exit;

?>