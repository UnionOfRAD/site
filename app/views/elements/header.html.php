<?php

$this->nav->add(
	'main',
	'News',
	'http://news.li3.me'
);
$this->nav->add(
	'main',
	'Manual',
	['library' => 'li3_docs', 'action' => 'view', 'controller' => 'ApiBrowser', 'lib' => 'manual']
);
$this->nav->add(
	'main',
	'API',
	['library' => 'li3_docs', 'action' => 'view', 'controller' => 'ApiBrowser', 'lib' => 'lithium']
);
$this->nav->add(
	'main',
	'Specs',
	['library' => 'li3_docs', 'action' => 'view', 'controller' => 'ApiBrowser', 'lib' => 'specs']
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
		<a href="/" class="logo" title="Lithium">⟁</a>
	</div>
	<div class="right">
		<?= $this->nav->generate('main', ['class' => 'main-nav', 'match' => 'loose']) ?>
	</div>
</header>