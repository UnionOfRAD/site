<?php
/**
 * li₃: the most RAD framework for PHP (http://li3.me)
 *
 * Copyright 2016, Union of RAD. All rights reserved. This source
 * code is distributed under the terms of the BSD 3-Clause License.
 * The full license text can be found in the LICENSE.txt file.
 */

use lithium\core\Libraries;
use lithium\core\ErrorHandler;
use lithium\action\Response;
use lithium\net\http\Media;
use lithium\analysis\Logger;
/*
ErrorHandler::apply('lithium\action\Dispatcher::run', array(), function($info, $params) {
	if (preg_match('/not found/i', $info['exception']->getMessage())) {
		$code = 404;
	} else {
		$code = $info['exception']->getCode() == 404 ? 404 : 500;
	}

	$response = new Response(array(
		'request' => $params['request'],
		'status' => $code
	));

	Media::render($response, compact('info', 'params'), array(
		'library' => true,
		'controller' => '_errors',
		'template' => $code == 404 ? 'fourohfour' : 'fiveohoh',
		'layout' => 'default',
		'request' => $params['request']
	));
	return $response;
});
 */

Logger::config([
	'default' => [
		'adapter' => 'Syslog',
		'priority' => ['debug', 'error', 'notice', 'warning'],
		'identity' => 'lithium_site@dev'
	],
]);

?>