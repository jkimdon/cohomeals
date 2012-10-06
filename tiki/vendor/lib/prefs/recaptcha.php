<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: recaptcha.php 28075 2010-07-20 11:41:48Z jonnybradley $

function prefs_recaptcha_list() {
    return array (
		'recaptcha_enabled' => array(
            'name' => tra('Use ReCaptcha'),
            'description' => tra('Use ReCaptcha, a specialized captcha service, instead of default CAPTCHA'),
			'hint' => tra('You will need to register at [http://www.google.com/recaptcha]'),
			'help' => 'Spam+protection',
			'type' => 'flag',
        ),
		'recaptcha_pubkey' => array(
			'name' => tra('Public Key'),
            'type' => 'text',
            'description' => tra('ReCaptcha public key.'),
        	'size' => 60,
		),
		'recaptcha_privkey' => array(
			'name' => tra('Private Key'),
			'type' => 'text',
            'description' => tra('ReCaptcha private key.'),
			'size' => 60,
		),
	);
}
