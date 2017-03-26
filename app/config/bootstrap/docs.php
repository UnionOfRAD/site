<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2017, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use li3_docs\models\Indexes;

// Register documentation indexes.
$base = dirname(dirname(dirname(__DIR__))) . '/tmp';

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