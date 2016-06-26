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
use Github\Client;
use Composer\Semver\VersionParser;
use Composer\Semver\Comparator;
use lithium\storage\Cache;
use li3_docs\models\Indexes;

class Versions extends \lithium\data\Model {

	protected $_meta = [
		'connection' => false
	];

	// Map our composer-like version string to a ref in the repo. Non released
	// versions must be affixed with `'.x-dev'`.
	public function ref($entity) {
		if ($entity->ref) {
			return $entity->ref;
		}
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

	public function tree($entity) {
		return 'https://github.com/UnionOfRAD/lithium/tree/' . $entity->ref();
	}

	public function docs($entity) {
		if (Comparator::lessThan($entity->name, '1.0.0-alpha')) {
			return false;
		}
		$index = Indexes::find('first', [
			'conditions' => [
				'type' => 'api',
				'name' => 'lithium',
				'version' => $entity->series(false)
			]
		]);
		if (!$index) {
			return false;
		}
		return [
			'library' => 'li3_docs',
			'controller' => 'Apis',
			'action' => 'view',
			'name' => 'lithium',
			'version' => $entity->series(false),
			'symbol' => $index->namespace
		];
	}

	// Changelogs exists beginning with 1.0.0-rc1
	public function changelog($entity) {
		if (Comparator::lessThan($entity->name, '1.0.0-rc1')) {
			return false;
		}
		return 'https://raw.githubusercontent.com/UnionOfRAD/lithium/' . $entity->ref() . '/CHANGELOG.md';
		// return 'https://github.com/UnionOfRAD/lithium/blob/' . $entity->ref() . '/CHANGELOG.md';
	}

	public function series($entity, $returnEntity = true) {
		if ($entity->name[0] === '0') {
			$series = '0.x';
		} elseif (strpos($entity->name, '-') === false) {
			$series = substr_replace($entity->name, 'x', -1);
		} else {
			$series = preg_replace('/([0-9x]-[a-z0-9]+$)/i', 'x', $entity->name);
		}
		if (!$returnEntity) {
			return $series;
		}
		return VersionSeries::find('all')->first(function($item) use ($series) {
			return $item->name === $series;
		});
	}

	public function isStable($entity) {
		return $entity->name[0] !== '0' && strpos($entity->name, '-') === false;
	}

	public static function data() {
		$results = [
			'1.1.x-dev' => [
				'name' => '1.1.x-dev',
				'ref' => '1.1',
				'isReleased' => false
			]
		];
		if (!$tags = Cache::read('default', 'gh-lithium-tags')) {
			$client = new Client();
			$tags = $client->api('repo')->tags('UnionOfRAD', 'lithium');
			Cache::write('default', 'gh-lithium-tags', $tags, '+1 day');
		}
		foreach ($tags as $tag) {
			if ($tag['name'][0] !== 'v') {
				continue; // only consider standarized tags
			}
			$results[$tag['name']] = [
				'name' => substr($tag['name'], 1),
				'ref' => $tag['name'],
				'isReleased' => true
			];
		}
		return $results;
	}
}

Versions::finder('first', function($self, $params, $chain) {
	$result = Versions::data()[$params['options']['conditions']['name']];

	if (!$result) {
		return false;
	}
	return Versions::create($result);
});

Versions::finder('all', function($self, $params, $chain) {
	$results = new Collection();

	foreach (Versions::data() as $item) {
		$results[] = Versions::create($item);
	}
	return $results;
});

?>