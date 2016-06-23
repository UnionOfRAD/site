<?php

use lithium\util\String;

?>
<footer class="main">
	<div class="area"></div>
	<div class="area"></div>
	<div class="area"></div>
	<div class="area"></div>

	<div class="social">
		<?= $this->html->link('GitHub', 'https://github.com/unionofrad', ['target' => 'new']) ?>
		<span class="separator">/</span>
		<?= $this->html->link('Twitter', 'https://twitter.com/unionofrad', ['target' => 'new']) ?>
		<span class="separator">/</span>
		<?= $this->html->link('Reddit', 'http://www.reddit.com/r/li3', ['target' => 'new']) ?>
		<span class="separator">/</span>
		<?= $this->html->link('Stack Overflow', 'https://stackoverflow.com/questions/tagged/lithium', ['target' => 'new']) ?>
	</div>
	<div class="testimonial">
		<?= $this->html->image($testimonial['url'], ['alt' => 'Testimonial Image']) ?>
		<p><?php echo nl2br($testimonial['body']) ?></p>
	</div>
	<div class="copyright">
		<?php echo String::insert('Pretty much everything is (c) 2009-{:year} and beyond, the {:holder}.', [
			'holder' => $this->html->link('Union of RAD', 'http://unionofrad.org'),
			'year' => date('Y')
		]); ?>
	</div>
</footer>