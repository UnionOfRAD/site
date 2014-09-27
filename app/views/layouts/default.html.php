<?php

use lithium\core\Environment;

$library = $this->request()->library;

?>
<!doctype html>
<html lang="en">
<head>
	<?php echo $this->html->charset();?>
	<title><?php
		$title = [];
		if ($this->title()) {
			$title[] = $this->title();
		}

		if ($library === 'li3_bot') {
			$title[] = 'Bot';
		}
		$title[] = 'li3';

		echo implode(' – ', $title);
	?></title>
echo () ? "{$title} – " : null ?>li3</title>
	<?php
		$styles = [
			'reset',
			'http://fonts.googleapis.com/css?family=Anonymous+Pro:400,700,400italic,700italic',
			'u1m'
		];
		switch ($library) {
			case 'li3_bot':
				$styles[] = 'li3_bot';
			break;
			case 'li3_docs':
				$styles[] = 'li3_docs';
				$styles[] = 'highlight';
			break;
			default:
				$styles[] = 'site';
				$styles[] = 'highlight';
			break;
		}
		echo $this->html->style($styles);
	?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->script([
		'//cdnjs.cloudflare.com/ajax/libs/require.js/2.1.10/require.min.js',
		'base',
		'//cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js'
	]) ?>
	<?php echo $this->scripts(); ?>
	<link rel="icon" href="/assets/ico/site.png">

	<?php if (Environment::is('production')): ?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-11048416-4', 'auto');
	  ga('send', 'pageview');
	</script>
	<?php endif ?>
</head>
<?php

$bodyClasses = [];
$bodyClasses[] = 'layout-default';
$bodyClasses[] = str_replace('_', '-', $library ?: 'site');

?>
<body class="<?= implode(' ', $bodyClasses) ?>">
		<div id="container">
			<?=$this->view()->render(['element' => 'header'], [], [
				'library' => 'app'
			]) ?>
			<?php if ($library == 'li3_docs'): ?>
				<?php echo $this->_view->render(
					array('element' => 'crumbs'), compact('object'), array('library' => 'li3_docs')
				); ?>
			<?php elseif ($library == 'li3_bot'): ?>
				<?php if (isset($breadcrumbs)): ?>
					<?php echo $this->_view->render(
						array('element' => 'crumbs'), ['data' => $breadcrumbs], array('library' => 'li3_bot')
					); ?>
				<?php endif; ?>
			<?php endif ?>
			<div id="content">
				<?php echo $this->content() ?>
			</div>
		</div>
		<?=$this->view()->render(['element' => 'footer'], compact('testimonial'), [
			'library' => 'app'
		]) ?>
	</body>
</body>
</html>