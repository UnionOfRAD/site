<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

define('PROJECT_NAME', 'lithium_site');
define('PROJECT_VERSION', '2.0.0-alpha+__PROJECT_VERSION_BUILD__');
define('PROJECT_VERSION_BUILD', '__PROJECT_VERSION_BUILD__');

/**
 * This is the primary bootstrap file of your application, and is loaded immediately after the front
 * controller (`webroot/index.php`) is invoked. It includes references to other feature-specific
 * bootstrap files that you can turn on and off to configure the services needed for your
 * application.
 *
 * Besides global configuration of external application resources, these files also include
 * configuration for various classes to interact with one another, usually through _filters_.
 * Filters are Lithium's system of creating interactions between classes without tight coupling. See
 * the `Filters` class for more information.
 *
 * If you have other services that must be configured globally for the entire application, create a
 * new bootstrap file and `require` it here.
 *
 * @see lithium\util\collection\Filters
 */

/**
 * The libraries file contains the loading instructions for all plugins, frameworks and other class
 * libraries used in the application, including the Lithium core, and the application itself. These
 * instructions include library names, paths to files, and any applicable class-loading rules. This
 * file also statically loads common classes to improve bootstrap performance.
 */
require __DIR__ . '/bootstrap/libraries.php';

/**
 * The error configuration allows you to use the filter system along with the advanced matching
 * rules of the `ErrorHandler` class to provide a high level of control over managing exceptions in
 * your application, with no impact on framework or application code.
 */
require __DIR__ . '/bootstrap/errors.php';

/**
 * This file defines bindings between classes which are triggered during the request cycle, and
 * allow the framework to automatically configure its environmental settings. You can add your own
 * behavior and modify the dispatch cycle to suit your needs.
 */
require __DIR__ . '/bootstrap/action.php';

/**
 * This file contains configurations for connecting to external caching resources, as well as
 * default caching rules for various systems within your application
 */
require __DIR__ . '/bootstrap/cache.php';

/**
 * Include this file if your application uses one or more database connections.
 */
require __DIR__ . '/bootstrap/connections.php';

/**
 * This file contains configuration for session (and/or cookie) storage, and user or web service
 * authentication.
 */
// require __DIR__ . '/bootstrap/session.php';

/**
 * This file contains your application's globalization rules, including inflections,
 * transliterations, localized validation, and how localized text should be loaded. Uncomment this
 * line if you plan to globalize your site.
 */
date_default_timezone_set('UTC');
// require __DIR__ . '/bootstrap/g11n.php';

/**
 * This file contains configurations for handling different content types within the framework,
 * including converting data to and from different formats, and handling static media assets.
 */
require __DIR__ . '/bootstrap/media.php';

/**
 * This file configures console filters and settings, specifically output behavior and coloring.
 */
if (PHP_SAPI === 'cli') {
	require __DIR__ . '/bootstrap/console.php';
}

require __DIR__ . '/bootstrap/environment.php';

use lithium\core\Libraries;
use lithium\net\http\Media;
use app\models\Testimonials;
use li3_docs\models\Indexes;

Media::applyFilter('_handle', function($self, $params, $chain) {
	if ($params['handler']['type'] == 'html') {
		$params['data']['testimonial'] = Testimonials::random();
	}
	return $chain->next($self, $params, $chain);
});

// Register documentation indexes.
$base = dirname(__DIR__) . '/resources/docs';

Indexes::register([
	'type' => 'book',
	'title' => 'li₃: The Definitive Guide',
	'name' => 'manual',
	'version' => '1.x',
	'path' => $base . '/manual_1',
	'description' => <<<TEXT
This is your handbook to building li₃ applications. It takes you through getting started,
and provides an overview of all aspects of application-building that are covered by the
framework.
TEXT
]);
Indexes::register([
	'type' => 'api',
	'title' => 'Framework API',
	'name' => 'lithium',
	'version' => '1.1.x',
	'path' => $base . '/lithium_11',
	'namespace' => 'lithium',
	'description' => <<<TEXT
The framework's detailed technical API documentation.
TEXT
]);
Indexes::register([
	'type' => 'api',
	'title' => 'Framework API',
	'name' => 'lithium',
	'version' => '1.0.x',
	'path' => $base . '/lithium_10',
	'namespace' => 'lithium'
]);

Indexes::register([
	'type' => 'book',
	'title' => 'Specifications',
	'name' => 'specs',
	'version' => '1.x',
	'path' => $base . '/specs',
	'description' => <<<TEXT
Specifications (or specs for short) help us take li₃ further. Have a look
at coding and documentation standards.
TEXT
]);

?>