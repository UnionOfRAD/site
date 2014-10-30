<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use lithium\core\Libraries;
use lithium\core\ErrorHandler;
use lithium\action\Response;
use lithium\net\http\Media;
use lithium\analysis\Logger;

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

Logger::config([
	'default' => [
		'adapter' => 'File',
		'path' => dirname(Libraries::get(true, 'path')) . '/log',
		'timestamp' => '[Y-m-d H:i:s]',
		// Log everything into one file.
		'file' => function($data, $config) { return 'app.log'; },
		'priority' => ['debug', 'error', 'notice', 'warning']
	],
]);

?>