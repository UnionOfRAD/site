<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

use app\models\Eurekas;
use app\models\Posts;
use app\models\Projects;
use app\models\VersionSeries;
use app\models\Versions;
use jsend\Response as JSendResponse;
use lithium\core\Environment;
use li3_docs\models\Indexes;

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
		$eureka = Eurekas::find('random');
		$projects = Projects::find('all');
		$posts = Posts::latest();
		$docs = Indexes::find('grouped', [
			'conditions' => [
				'name' => ['manual', 'lithium']
			]
		]);

		$stableVersion = VersionSeries::findByName('1.1.x')->versions()->first();
		$nextVersion = VersionSeries::findByName('1.2.x')->versions()->first();

		return compact('posts', 'eureka', 'projects', 'stableVersion', 'nextVersion', 'docs');
	}

	public function support() {}

	public function present() {}

	public function development() {}

	public function versions() {
		$versions = Versions::all()->find(function($item) {
			return $item->isReleased === true;
		});
		$series = VersionSeries::all();
		return compact('series', 'versions');
	}

	public function api_verify_captcha() {
		$response = new JSendResponse();

		if (!$verified = $this->_verify($this->request)) {
			die('Failed to verify.');
		}

		if ($this->request->data['entity'] === 'mail.security') {
			$response->success([
				'email' => 'security@li3.me'
			]);
		}

		$this->render([
			'type' => $this->request->accepts(),
			'data' => $response->to('array')
		]);
	}

	protected function _verify($request) {
		$config = Environment::get('service.recaptcha');

		$url  = 'https://www.google.com/recaptcha/api/siteverify';
		$url .= '?secret=' . $config['secretKey'];
		$url .= '&response=' .$this->request->data['token'];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = json_decode(curl_exec($ch), true);
		curl_close($ch);

		return $result['success'] === true;
	}

	public function view() {
		$options = [];
		$path = func_get_args();

		if (!$path || $path === ['home']) {
			$path = ['home'];
			$options['compiler'] = ['fallback' => true];
		}

		$options['template'] = join('/', $path);
		return $this->render($options);
	}
}

?>