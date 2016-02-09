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
use app\models\Versions;
use jsend\Response as JSendResponse;
use lithium\core\Environment;

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

		$version = Versions::all()->first(function($item) {
			return $item->isPromoted;
		});

		return compact('posts', 'eureka', 'projects', 'version');
	}

	public function support() {}

	public function present() {}

	public function development() {}

	public function versions() {
		$data = Versions::all();
		return compact('data');
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

		$this->render(array(
			'type' => $this->request->accepts(),
			'data' => $response->to('array')
		));
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