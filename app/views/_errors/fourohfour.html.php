<?php

$this->title('404 Not Found');

$internal = 'li3';
$searchEngines = [
	'bing', 'google', 'yahoo', 'altavista',
	'facebook', 'duckduckgo'
];
$referer = $this->request()->env('HTTP_REFERER');

$internalReferal = false;
$searchReferal = false;
$searchTerms = null;

if (strpos($referer, 'li3') !== false) {
	$internalReferal = true;
} else {
	foreach ($searchEngines as $searchEngine) {
		if (strpos($referer, "{$searchEngine}.") !== false) {
			$searchReferal = $searchEngine;
			break;
		}
	}
}

if ($internalReferal) {
	// ...
} elseif ($searchReferal) {
	parse_str(urldecode(parse_url($referer, PHP_URL_QUERY)), $query);

	if (isset($query['q'])) {
		$searchTerms = str_replace('+', ' ', $query['q']);
	}
}

?>
<article class="error error-404">
	<h1 class="h-alpha t-red"><span class="code digits">404</span> Not Found</h1>
	<p class="message">
		The page you're looking for could not be found.
	</p>
	<ul class="reason">
		<?php if ($internalReferal): ?>
			<li><You've followed a link from within the site. That links seems to be incorrectly setup.
		<?php elseif ($searchReferal): ?>
			<li><?php echo sprintf(
				"You did a search on <code>%s</code> for <code>%s</code>. However their search index appears to be partially out of date.",
				ucfirst($searchReferal),
				$searchTerms
			) ?>
		<?php elseif ($referer): ?>
			<li>If you've followed a link from somewhere the link may be out of date.
		<?php elseif (!$referer): ?>
			<li>If you typed in the address, it might have been misspelled.
			<li>If you've bookmarked this page the link may be out of date.
		<?php endif ?>
	</ul>
	<ul class="try">
		<?php if ($internalReferal): ?>
			<li>The administrator of this site has been notified and will fix the link as soon as possible.
			<li>
				<?php echo sprintf('Go back to the previous page which sent you here <strong>%s</strong>.', $this->html->link($referer)) ?>
	<?php elseif ($searchReferal): ?>
		<?php elseif ($referer): ?>
		<?php elseif (!$referer): ?>
			<li>Double-check the spelling of the address.
			<li>Update your bookmark.
		<?php endif ?>
		<li>
			<?php echo sprintf('Go to the frontpage at <strong>%s</strong', $this->html->link($this->url('/' , ['absolute' => true]), '/',
				['absolute' => true]
			)) ?>
	</ul>
</article>