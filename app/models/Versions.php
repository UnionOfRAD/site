<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\models;

use app\models\VersionSeries;
use lithium\util\Collection;

class Versions extends \lithium\data\Model {

	protected $_meta = [
		'connection' => false
	];

	// Map our composer-like version string to a ref in the repo. Non released
	// versions must be affixed with `'.x-dev'`.
	public function ref($entity) {
		if (preg_match('/^([0-9]+\.[0-9]+)\.x-dev$/', $entity->name, $matches)) {
			return $matches[1];
		}
		return 'v' . $entity->name;
	}

	public function tar($entity) {
		return 'https://github.com/UnionOfRAD/lithium/archive/' . $entity->ref() . '.tar.gz';
	}

	public function zip($entity) {
		return 'https://github.com/UnionOfRAD/lithium/archive/' . $entity->ref() . '.zip';
	}

	public function series($entity) {
		return VersionSeries::find('all')->first(function($item) use ($entity) {
			return $item->name === $entity->series;
		});
	}

	public static function data() {
		return [
			'1.1.x-dev' => [
				'name' => '1.1.x-dev',
				'series' => '1.1.x',
				'isStable' => false,
				'isPromoted' => true
			],
			'1.0.1' => [
				'name' => '1.0.1',
				'series' => '1.0.x',
				'isStable' => true,
				'isPromoted' => true
			],
			'1.0.0' => [
				'name' => '1.0.1',
				'series' => '1.0.x',
				'isStable' => true,
				'isPromoted' => true
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