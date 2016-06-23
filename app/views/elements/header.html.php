<?php

$this->nav->add(
	'main',
	'News',
	'http://news.li3.me'
);
$this->nav->add(
	'main',
	'Documentation',
	[
		'library' => 'li3_docs',
		'controller' => 'Docs',
		'action' => 'index'
	]
);
$this->nav->add(
	'main',
	'Versions',
	'Pages::versions'
);
$this->nav->add(
	'main',
	'Presentations',
	'Pages::present'
);
$this->nav->add(
	'main',
	'Community',
	'Pages::support'
);
$this->nav->add(
	'main',
	'Development',
	'Pages::development'
);

?>
<header class="main">
	<div class="left">
		<h1><a href="/" class="li3-logo">li3</a></h1>
	</div>
	<div class="right">
		<?= $this->nav->generate('main', ['class' => 'main-nav', 'match' => 'loose']) ?>
	</div>
</header>