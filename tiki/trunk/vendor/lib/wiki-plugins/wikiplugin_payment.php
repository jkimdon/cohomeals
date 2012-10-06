<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_payment.php 25177 2010-02-13 17:34:48Z changi67 $

function wikiplugin_payment_info() {
	return array(
		'name' => tra('Payment'),
		'description' => tra('Display a payment request\'s details based on the user\'s privileges and the state of the payment. The payment details may include the payment options.'),
		'prefs' => array( 'wikiplugin_payment', 'payment_feature' ),
		'params' => array(
			'id' => array(
				'required' => true,
				'name' => tra('Payment request number'),
				'description' => tra('Unique identifier'),
				'filter' => 'digits',
			),
		),
	);
}

function wikiplugin_payment( $data, $params ) {
	global $smarty;

	require_once 'lib/smarty_tiki/function.payment.php';
	return '^~np~' . smarty_function_payment( $params, $smarty ) . '~/np~^';
}

