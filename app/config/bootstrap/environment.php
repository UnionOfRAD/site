<?php

use lithium\core\Environment;

$config = [
	'service' => [
		'tumblr' => [
			'name' => 'unionofrad-li3',
			'url' => 'http://news.li3.me',
			'consumerKey' => '',
			'consumerSecret' => '',
			'token' => '',
			'tokenSecret' => ''
		]
	]
];
Environment::set('development', $config);
Environment::set('staging', $config);
Environment::set('production', $config);

?>