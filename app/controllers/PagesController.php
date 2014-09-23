<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

use Exception;
use lithium\storage\Cache;
use lithium\core\Libraries;
use lithium\core\Environment;
use Tumblr\API\Client as Tumblr;
use Guzzle\Http\Exception\CurlException;
use app\models\Eurekas;
use app\models\Projects;

/**
 * This controller is used for serving static pages by name, which are located in the `/views/pages`
 * folder.
 *
 * A Lithium application's default routing provides for automatically routing and rendering
 * static pages using this controller. The default route (`/`) will render the `home` template, as
 * specified in the `view()` action.
 *
 * Additionally, any other static templates in `/views/pages` can be called by name in the URL. For
 * example, browsing to `/pages/about` will render `/views/pages/about.html.php`, if it exists.
 *
 * Templates can be nested within directories as well, which will automatically be accounted for.
 * For example, browsing to `/pages/about/company` will render
 * `/views/pages/about/company.html.php`.
 */
class PagesController extends \lithium\action\Controller {

	public function home() {
		$cacheKey = 'latest_posts';

		if (!$posts = Cache::read('default', $cacheKey)) {
			$config = Environment::get('service.tumblr');

			try {
				$client = new Tumblr(
					$config['consumerKey'],
					$config['consumerSecret'],
					$config['token'],
					$config['tokenSecret']
				);
				$results = $client->getBlogPosts($config['name'], ['limit' => 2]);
				$posts = $results->posts;

				Cache::write('default', $cacheKey, $posts, '+1 day');
			} catch (CurlException $e) {
				$posts = [];
			} catch (Exception $e) {
				$posts = [];
			}
		}
		$results = [];
		foreach ($posts as $post) {
			if ($post->timestamp < strtotime('-4 months')) {
				continue;
			}
			$results[] = $post;
		}
		$posts = $results;

		$eureka = Eurekas::find('random');
		$projects = Projects::find('all');

		return compact('posts', 'eureka', 'projects');
	}

	public function support() {}

	public function present() {}

	public function development() {
		$file = Libraries::get('lithium', 'path') . '/CONTRIBUTING.md';
		$contributing = file_get_contents($file);
	//	var_dump($contributing);
	}

	public function view() {
		$options = array();
		$path = func_get_args();

		if (!$path || $path === array('home')) {
			$path = array('home');
			$options['compiler'] = array('fallback' => true);
		}

		$options['template'] = join('/', $path);
		return $this->render($options);
	}
}

?>