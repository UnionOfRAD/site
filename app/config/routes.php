<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * The routes file is where you define your URL structure, which is an important part of the
 * [information architecture](http://en.wikipedia.org/wiki/Information_architecture) of your
 * application. Here, you can use _routes_ to match up URL pattern strings to a set of parameters,
 * usually including a controller and action to dispatch matching requests to. For more information,
 * see the `Router` and `Route` classes.
 *
 * @see lithium\net\http\Router
 * @see lithium\net\http\Route
 */
use lithium\net\http\Router;
use lithium\action\Response;

Router::connect('/', 'Pages::home');
Router::connect('/support', 'Pages::support');
Router::connect('/development', 'Pages::development');
Router::connect('/versions', 'Pages::versions');
Router::connect('/present', 'Pages::present');
Router::connect('/captcha/verify', [
	'controller' => 'Pages', 'action' => 'api_verify_captcha'
]);

/* Deprecated / BC */

// Renamed but popular pages
$renamed = [
	'/docs/manual/common-tasks/basic-filters.md' => '/docs/book/manual/1.x/common-tasks/filters',
	'/docs/manual/views/views.md' => '/docs/book/manual/1.x/views/',
	'/manual' => '/docs/book/manual/1.x/',
	'/docs/manual/configuration/servers/nginx.wiki' => '/docs/book/manual/1.x/installation/web-servers',
	'/docs/manual/handling-http-requests/helpers.wiki' => '/docs/book/manual/1.x/views/helpers'
];
foreach ($renamed as $from => $to) {
	Router::connect($from, [], function($request) use ($to) {
		return new Response([
			'location' => $to
		]);
	});
}

Router::connect('/docs/book/{:name}/{:version}/{:page:[a-zA-Z\/\-_0-9]+}.md',
	[], function($request) {
	return new Response([
		'location' => [
			'library' => 'li3_docs',
			'controller' => 'Books',
			'action' => 'view',
			'name' => $request->name,
			'version' => $request->params['version'],
			'page' => $request->page
		]
	]);
});

Router::connect('/docs/manual/{:page:.*}', [], function($request) {
	return new Response([
		'location' => [
			'library' => 'li3_docs',
			'controller' => 'Books',
			'action' => 'view',
			'name' => 'manual',
			'version' => '1.x',
			'page' => str_replace(['.wiki', '.md'], '', $request->page)
		]
	]);
});
Router::connect('/docs/manual', [], function($request) {
	return new Response([
		'location' => [
			'library' => 'li3_docs',
			'controller' => 'Books',
			'action' => 'view',
			'name' => 'manual',
			'version' => '1.x'
		]
	]);
});
Router::connect('/docs/specs/{:page:.*}', [], function($request) {
	return new Response([
		'location' => [
			'library' => 'li3_docs',
			'controller' => 'Books',
			'action' => 'view',
			'name' => 'specs',
			'version' => '1.x',
			'page' => str_replace(['.wiki', '.md'], '', $request->page)
		]
	]);
});
Router::connect('/docs/specs', [], function($request) {
	return new Response([
		'location' => [
			'library' => 'li3_docs',
			'controller' => 'Books',
			'action' => 'view',
			'name' => 'specs',
			'version' => '1.x'
		]
	]);
});

Router::connect('/docs/lithium/{:partialSymbol:.*}', [], function($request) {
	return new Response([
		'location' => [
			'library' => 'li3_docs',
			'controller' => 'Apis',
			'action' => 'view',
			'name' => 'lithium',
			'version' => '1.0.x',
			'symbol' => 'lithium/' . $request->partialSymbol
		]
	]);
});
Router::connect('/docs/lithium', [], function($request) {
	return new Response([
		'location' => [
			'library' => 'li3_docs',
			'controller' => 'Apis',
			'action' => 'view',
			'name' => 'lithium',
			'version' => '1.0.x',
			'symbol' => 'lithium'
		]
	]);
});

?>