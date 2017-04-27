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
	301 => [
		// Before li3_docs 2.0
		'/docs/lithium' => '/docs/api/lithium/1.0.x',
		'/docs/manual/quickstart' => '/docs/book/manual/1.x/quickstart',
		'/docs/manual/installation' => '/docs/book/manual/1.x/installation',
		'/docs/manual' => '/docs/book/manual/1.x',

		// Incoming from external tutorial sites.
		'/docs/manual/common-tasks/basic-filters.md' => '/docs/book/manual/1.x/common-tasks/filters',
		'/docs/manual/views/views.md' => '/docs/book/manual/1.x/views/',
		'/docs/manual/configuration/servers/nginx.wiki' => '/docs/book/manual/1.x/installation/web-servers',
		'/docs/manual/handling-http-requests/helpers.wiki' => '/docs/book/manual/1.x/views/helpers',
		'/docs/manual/handling-http-requests/routing.md' => '/docs/book/manual/1.x/controllers/routing',
		'/docs/manual/handling-http-requests/views.md' => '/docs/book/manual/1.x/views',
		'/docs/manual/working-with-data/using-models.md' => '/docs/book/manual/1.x/models',
		'/docs/app/config/routes' => 'https://github.com/UnionOfRAD/framework/blob/master/app/config/routes.php',
	],
	302 => [
		// Renamed after new li3_docs 2.0 deployment (ongoing)
		// These are usually not linked.
		'/docs/book/manual/1.x/security' => '/docs/book/manual/1.x/quality-code/security',

		// Very old routes. Too generic for use with 301. We might need this later.
		'/manual' => '/docs/book/manual/1.x/',
	],

];
foreach ($renamed[301] as $from => $to) {
	Router::connect($from, [], function($request) use ($to) {
		return new Response([
			'location' => $to,
			'status' => 301
		]);
	});
}
foreach ($renamed[302] as $from => $to) {
	Router::connect($from, [], function($request) use ($to) {
		return new Response([
			'location' => $to,
			'status' => 302
		]);
	});
}

// Redirect /docs/manual/* to /docs/book/manual/1.x/* as well as specs.
Router::connect('/docs/{name:(manual|specs)}/{:page:.*}', [], function($request) {
	return new Response([
		'location' => [
			'library' => 'li3_docs',
			'controller' => 'Books',
			'action' => 'view',
			'name' => $request->name,
			'version' => '1.x',
			'page' => str_replace(['.wiki', '.md'], '', $request->page)
		]
	]);
});

// Redirect old lithium API.
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

?>