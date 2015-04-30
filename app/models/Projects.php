<?php

namespace app\models;

use lithium\core\Libraries;
use lithium\util\Collection;

class Projects extends \lithium\data\Model {

	protected $_meta = [
		'connection' => false
	];

	public static function find($type, array $options = array()) {
		$data = static::_data();

		if ($type === 'all') {
			$results = [];

			foreach ($data as $item) {
				$results[] = static::create($item);
			}
			return new Collection(['data' => $results]);
		}
	}

	protected static function _data() {
		return [
			[
				'launched' => 2013,
				'title' => 'MoodPik',
				'url' => 'http://moodpik.com/',
				'client_name' => null,
				'client_url' => null,
				'author_name' => 'Radify',
				'author_url' => 'http://radify.io'
			],
			[
				'launched' => 2014,
				'title' => 'Transdirect',
				'url' => 'https://www.transdirect.com.au/',
				'client_name' => null,
				'client_url' => null,
				'author_name' => 'bywave',
				'author_url' => 'http://bywave.com.au'
			],
			/*
			[
				'launched' => 2014,
				'title' => 'Pearson Clinical',
				'url' => 'http://pearsonclinical.com.au/',
				'client_name' => null,
				'client_url' => null,
				'author_name' => 'bywave',
				'author_url' => 'http://bywave.com.au'
			],
			 */
			[
				'launched' => 2014,
				'title' => 'Kleiderei',
				'url' => 'https://kleiderei.com/',
				'client_name' => 'Kleiderei Hamburg UG',
				'client_url' => null,
				'author_name' => 'Atelier Disko',
				'author_url' => 'http://atelierdisko.de'
			],
			[
				'launched' => 2015,
				'title' => 'Tocotronic',
				'url' => 'http://tocotronic.de',
				'client_name' => 'Universal Music',
				'client_url' => null,
				'author_name' => 'Atelier Disko',
				'author_url' => 'http://atelierdisko.de'
			],
			[
				'launched' => 2012,
				'title' => 'dacardworld.com',
				'url' => 'http://www.dacardworld.com/',
				'client_name' => 'Dave and Adam\'s Card World LLC',
				'client_url' => null,
				'author_name' => 'Eric Cholis',
				'author_url' => 'http://www.ericcholis.com/'
			],
			[
				'launched' => 2012,
				'title' => 'Workana',
				'url' => 'https://www.workana.com/',
				'client_name' => null,
				'client_url' => null,
				'author_name' => 'Workana LLC',
				'author_url' => null
			],
			[
				'launched' => 2011,
				'title' => 'The Friday Flyer',
				'url' => 'http://fridayflyer.com/',
				'client_name' => null,
				'client_url' => null,
				'author_name' => 'David Golding',
				'author_url' => 'https://github.com/davidgolding'
			],
		];
	}
}

?>