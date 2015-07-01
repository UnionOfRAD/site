<?php

namespace app\models;

use lithium\util\Collection;
use Tumblr\API\Client as Tumblr;
use textual\Modulation as Textual;
use Guzzle\Http\Exception\CurlException;
use Exception;
use lithium\storage\Cache;
use lithium\core\Environment;

class Posts extends \lithium\data\Model {

	protected $_meta = [
		'connection' => false
	];

	protected static $_serviceConfig = [];

	public static function init() {
		static::$_serviceConfig = Environment::get('service.tumblr');
	}

	public static function latest() {
		$cacheKey = 'posts_latest';

		if ($cached = Cache::read('default', $cacheKey)) {
			return $cached;
		}
		$config = static::$_serviceConfig;

		try {
			$client = new Tumblr(
				$config['consumerKey'],
				$config['consumerSecret'],
				$config['token'],
				$config['tokenSecret']
			);
			$results = $client->getBlogPosts($config['name'], ['limit' => 2]);
			$results = $results->posts;

		} catch (CurlException $e) {
			return [];
		} catch (Exception $e) {
			return [];
		}

		$results = (new Collection(['data' => $results]))
			->find(function($item) {
				return $item->timestamp >= strtotime('-2 months');
			})
			->each(function($item) {
				return static::create((array) $item);
			});

		Cache::write('default', $cacheKey, $results, '+1 hour');
		return $results;
	}

	public function teaser($entity) {
		$html = $entity->body;

		$html = preg_replace('#\<div.class\=.credit.*\/div\>#mis','', $html);
		$html = strip_tags($html);
		$html = Textual::limit($html, 190, ['html' => true]);

		return $html;
	}
}

Posts::init();

?>