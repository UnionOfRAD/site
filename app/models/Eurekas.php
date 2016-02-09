<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\models;

use lithium\core\Libraries;
use lithium\util\Collection;
use cebe\markdown\GithubMarkdown;

class Eurekas extends \lithium\data\Model {

	protected $_meta = [
		'connection' => false
	];

	protected static $_parser;

	public static function init() {
		static::$_parser = new GithubMarkdown();
		static::$_parser->html5 = true;
	}

	public static function files() {
		return glob(Libraries::get(true, 'resources') . '/eurekas/*.md');
	}

	public function body($entity) {
		return static::$_parser->parse(file_get_contents($entity->file));
	}
}

Eurekas::init();

Eurekas::finder('all', function($self, $params, $chain) {
	$files = Eurekas::files();

	$results = [];

	foreach ($files as $file) {
		$results[] = Eurekas::create(compact('file'));
	}
	return new Collection(['data' => $results]);
});

Eurekas::finder('random', function($self, $params, $chain) {
	$files = Eurekas::files();
	return Eurekas::create([
		'file' => $files[abs(crc32(date('Y-m-d'))) % count($files)]
	]);
});

?>