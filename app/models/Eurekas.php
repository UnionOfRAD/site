<?php

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

	public static function find($type, array $options = array()) {
		$files = static::_files();

		if ($type === 'all') {
			$results = [];

			foreach ($files as $file) {
				$results[] = static::create(compact('file'));
			}
			return new Collection(['data' => $results]);
		}
		if ($type === 'random') {
			return static::create([
				'file' => $files[abs(crc32(date('Y-m-d'))) % count($files)]
			]);
		}
	}

	protected static function _files() {
		return glob(Libraries::get(true, 'resources') . '/eurekas/*.md');
	}

	public function body($entity) {
		return static::$_parser->parse(file_get_contents($entity->file));
	}
}

Eurekas::init();

?>