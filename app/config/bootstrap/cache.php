<?php
/**
 * li₃: the most RAD framework for PHP (http://li3.me)
 *
 * Copyright 2016, Union of RAD. All rights reserved. This source
 * code is distributed under the terms of the BSD 3-Clause License.
 * The full license text can be found in the LICENSE.txt file.
 */

use lithium\action\Dispatcher;
use lithium\aop\Filters;
use lithium\storage\Cache;
use lithium\storage\cache\adapter\Apc;
use lithium\core\Libraries;
use lithium\core\Environment;
use lithium\data\Connections;
use lithium\data\source\Database;

/**
 * Configuration
 *
 * Configures the adapters to use with the cache class. Available adapters are `Memcache`,
 * `File`, `Redis`, `Apc`, `XCache` and `Memory`. Please see the documentation on the
 * adapters for specific characteristics and requirements.
 *
 * Most of this code is for getting you up and running only, and should be replaced with
 * a hard-coded configuration, based on the cache(s) you plan to use.
 *
 * We create a default cache configuration using the most optimized adapter available, and
 * use it to provide default caching for high-overhead operations. If APC is not available
 * and we can't degrade to file based caching, bail out.
 *
 * @see lithium\storage\Cache
 * @see lithium\storage\cache\adapters
 * @see lithium\storage\cache\strategies
 */
Cache::config([
	'default' => [
		'adapter' => 'Memcache',
		'scope' => PROJECT_NAME . '_' . md5(LITHIUM_APP_PATH . PROJECT_VERSION),
		'host' => 'cache.test'
	]
]);

/**
 * Apply
 *
 * Applies caching to neuralgic points of the framework but only when we are running
 * in production. This is also a good central place to add your own caching rules.
 *
 * A couple of caching rules are already defined below:
 *  1. Cache paths for auto-loaded and service-located classes.
 *  2. Cache describe calls on all connections that use a `Database` based adapter.
 *
 * @see lithium\core\Environment
 * @see lithium\core\Libraries
 */
if (!Environment::is('production')) {
	return;
}

Filters::apply(Dispatcher::class, 'run', function($params, $next) {
	$cacheKey = 'core.libraries';

	if ($cached = Cache::read('default', $cacheKey)) {
		$cached = (array) $cached + Libraries::cache();
		Libraries::cache($cached);
	}
	$result = $next($params);

	if ($cached != ($data = Libraries::cache())) {
		Cache::write('default', $cacheKey, $data, '+1 day');
	}
	return $result;
});

Filters::apply(Dispatcher::class, 'run', function($params, $next) {
	foreach (Connections::get() as $name) {
		if (!(($connection = Connections::get($name)) instanceof Database)) {
			continue;
		}
		Filters::apply($connection, 'describe', function($params, $next) use ($name) {
			if ($params['fields']) {
				return $next($params);
			}
			$cacheKey = "data.connections.{$name}.sources.{$params['entity']}.schema";

			return Cache::read('default', $cacheKey, [
				'write' => function() use ($params, $next) {
					return ['+1 day' => $next($params)];
				}
			]);
		});
	}
	return $next($params);
});

if (!Environment::is('development')) {
	Filters::apply(Dispatcher::class, 'run', function($self, $params, $chain) {
		$request = $params['request'];

		if (!$request->is('get')) {
			return $chain->next($self, $params, $chain);
		}
		$cacheKey = 'fpc_' . md5($request->env('REQUEST_URI'));

		if ($cached = Cache::read('default', $cacheKey)) {
			return $cached;
		}
		$response = $chain->next($self, $params, $chain);

		switch ($request->url) {
			case (strpos($request->url, '/bot') === 0):
				$ttl = '+2 minutes';
			case '/':
				$ttl = '+1 hour';
			default:
				$ttl = Cache::PERSIST;
		}
		Cache::write('default', $cacheKey, $response, $ttl);
		return $response;
	});

	Dispatcher::applyFilter('run', function($self, $params, $chain) {
		$request  = $params['request'];
		$response = $chain->next($self, $params, $chain);

		// Cache only HTML responses, JSON responses come from
		// APIs and are most often highly dynamic.
		if (!$request->is('get') || $response->type() !== 'html') {
			return $response;
		}
		$hash = 'W/' . md5(serialize([
			$response->body,
			$response->headers,
			PROJECT_VERSION
		]));
		$condition = trim($request->get('http:if_none_match'), '"');

		if ($condition === $hash) {
			$response->status(304);
			$response->body = [];
		}
		$response->headers['ETag'] = "\"{$hash}\"";
		return $response;
	});
}

?>
