
[Route handlers](/docs/lithium/net/http/Route::$_handler) are API's best friend.

```php
use lithium\net\http\Router;
use lithium\net\http\Response;	

Router::connect('/testimonial.json', function($request) {
	return new Response([
		'type' => 'json',
		'body' => json_encode(Testimonials::random())
	]);
});
```
