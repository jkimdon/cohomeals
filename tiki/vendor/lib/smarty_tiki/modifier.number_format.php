<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: modifier.number_format.php 28331 2010-08-06 05:12:16Z pkdille $

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty substring modifier plugin
 *
 * Type:     modifier<br>
 * Name:     number_format<br>
 * Purpose:  Format a number. Same arguments as
 *           PHP number_format function.
 * @link based on number_format(): http://www.php.net/manual/function.number-format.php
 * @author   lindon
 * @param number
 * @param decimals: sets the number of decimal places (default=0)
 * @param dec_point: sets the separator for the decimal point
 * @param thousands: thousands separator
 * @return number
 */
function smarty_modifier_number_format($number, $decimals, $dec_point = null, $thousands = null) {
	$dec_point = separator($dec_point);
	$thousands = separator($thousands);
	return number_format($number, $decimals, $dec_point, $thousands);
}

function separator($sep) {
	switch ($sep) {
		case 'c':
			$sep = ',';
			break;
		case 's':
			$sep = ' ';
			break;
	}
	return $sep;
}
