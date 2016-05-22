<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\models;

use lithium\util\Collection;

class Versions extends \lithium\data\Model {

	protected $_meta = [
		'connection' => false
	];

	// Map our composer-like version string to a ref in the repo. Non released
	// versions must be affixed with `'.x-dev'`.
	public function ref($entity) {
		if (preg_match('/^([0-9]+\.[0-9]+)\.x-dev$/', $entity->version, $matches)) {
			return $matches[1];
		}
		return 'v' . $entity->version;
	}

	public function tar($entity) {
		return 'https://github.com/UnionOfRAD/lithium/archive/' . $entity->ref() . '.tar.gz';
	}

	public function zip($entity) {
		return 'https://github.com/UnionOfRAD/lithium/archive/' . $entity->ref() . '.zip';
	}

	public static function data() {
		return [
			[
				'series' => '1.0.x',
				'version' => '1.0.0-rc4',
				'required' => '>=5.3.6 <7.0.0',
				'recommended' => '>=5.4.0 <7.0.0',
				'isPromoted' => true
			],
			[
				'series' => '1.1.x',
				'version' => '1.1.x-dev',
				'required' => '>=5.5.14 <7.0.0 || >=7.0.3',
				'recommended' => '>=5.6.0 <7.0.0 || >=7.0.3',
			],
		];
	}
}

Versions::finder('all', function($self, $params, $chain) {
	$results = new Collection();

	foreach (Versions::data() as $item) {
		$results[] = Versions::create($item);
	}
	return $results;
});

?>