<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\models;

use app\models\Versions;
use lithium\util\Collection;

class VersionSeries extends \lithium\data\Model {

	protected $_meta = [
		'connection' => false
	];

	public static function data() {
		return [
			'2.0.x' => [
				'name' => '2.0.x',
				'required' => '^7.0.3',
				'recommended' => '^7.1.0'
			],
			'1.2.x' => [
				'name' => '1.2.x',
				'required' => '^5.6.0 || ^7.0.3',
				'recommended' => '^7.0.3'
			],
			'1.1.x' => [
				'name' => '1.1.x',
				'required' => '^5.5.14 || ^7.0.3',
				'recommended' => '^5.6.0 || ^7.0.3'
			],
			'1.0.x' => [
				'name' => '1.0.x',
				'required' => '^5.3.6',
				'recommended' => '^5.4.0'
			],
			'0.x' => [
				'name' => '0.x',
				'required' => '^5.3.6',
				'recommended' => '^5.4.0'
			],
		];
	}

	public function versions($entity) {
		return Versions::find('all')->find(function($item) use ($entity) {
			return $item->series(false) === $entity->name;
		});
	}
}

VersionSeries::finder('first', function($params, $next) {
	$result = VersionSeries::data()[$params['options']['conditions']['name']];

	if (!$result) {
		return false;
	}
	return VersionSeries::create($result);
});

VersionSeries::finder('all', function($params, $next) {
	$results = new Collection();

	foreach (VersionSeries::data() as $item) {
		$results[] = VersionSeries::create($item);
	}
	return $results;
});

?>