<?php

$this->title('li3: The most RAD framework for PHP');
$this->set([
	'meta' => [
		'description' => 'li3 is the first and only major PHP framework built from the ground up for PHP 5.3+, and the first to break ground into major new technologies.'
	]
]);

?>
<article class="fullwidth home">
	<section class="hero">
		<div class="area"></div>
		<div class="area"></div>
		<div class="area"></div>
		<div class="area"></div>

		<div class="text">
			<h1 class="h-alpha">You asked for a better framework. Here it is.</h1>
			<div></div>
			<h2 class="h-beta">li₃ is the fast, flexible and most RAD development framework for PHP</h1>
			<nav>
				<?= $this->html->link('Quickstart', [
					'library' => 'li3_docs',
					'controller' => 'Books',
					'action' => 'view',
					'name' => 'manual',
					'version' => '1.x',
					'page' => 'quickstart'
				], ['class' => 'button large quickstart']) ?>
				<?= $this->html->link('Source', 'https://github.com/unionofrad/lithium', ['class' => 'button icon large source']) ?>
			</nav>
			<div class="download-buttons">
				<a href="<?= $nextVersion->tree() ?>" target="new" class="download button large next">
					<span class="download__title">Download Next</span>
					<span class="download__version">
						li₃ version <?= $nextVersion->name ?>
					</span>
				</a>
				<a href="<?= $stableVersion->tree() ?>" target="new" class="download button large">
					<span class="download__title">Download Stable</span>
					<span class="download__version">
						li₃ version <?= $stableVersion->name ?>
					</span>
				</a>
			</div>
		</div>
	</section>

	<?php if ($posts): ?>
	<section class="latest-posts">
		<?php foreach ($posts as $post): ?>
			<article class="post-item">
				<h1 class="h-beta"><?= $this->html->link($post->title, $post->post_url) ?></h1>
				<time><?= date('m/d/Y', $post->timestamp) ?></time>
				<div class="body">
					<?php echo $post->teaser() ?>
					&nbsp;[<?= $this->html->link('read&nbsp;more', $post->post_url, ['class' => 'read-more', 'escape' => false]) ?>]
				</div>
			</article>
		<?php endforeach ?>
	</section>
	<hr class="section-separator lightblue">
	<?php endif ?>

	<section class="docs">
		<div class="jumpboxes">
		<?php foreach ($docs as $name => $indexes): ?>
			<div class="jumpbox jumpbox--<?= $indexes[0]->type ?>">
				<div class="jumpbox__title">
					<?= $indexes[0]->title() ?>
				</div>
				<div class="jumpbox__actions">
					<?php foreach ($indexes as $index): ?>
						<?php if ($index->type === 'book'): ?>
							<?php echo $this->html->link($index->version, [
								'library' => 'li3_docs',
								'controller' => $index->type . 's',
								'action' => 'view',
								'name' => $index->name,
								'version' => $index->version
							], ['class' => 'jumpbox__version']) ?>
						<?php else: ?>
							<?php echo $this->html->link($index->version, [
								'library' => 'li3_docs',
								'controller' => $index->type . 's',
								'action' => 'view',
								'name' => $index->name,
								'version' => $index->version,
								'symbol' => $index->namespace
							], ['class' => 'jumpbox__version']) ?>
						<?php endif ?>
					<?php endforeach ?>
				</div>
				<div class="jumpbox__description"><?= $indexes[0]->description ?></div>
			</div>
		<?php endforeach ?>
		</div>
	</section>
	<hr class="section-separator lightblue">

	<section class="features">
		<h1 class="h-alpha t-red">What is li₃?</h1>
		<article>
			<h1 class="h-gamma">A framework of firsts</h1>
			<p>
				li₃ is the first and only major PHP framework built from
				the ground up for PHP 5.3+, and the first to break ground into major
				new technologies, including bridging the gap between relational and
				non-relational databases through a single, unified API.
			</p>
		</article>

		<article>
			<h1 class="h-gamma">Promiscuously opinionated</h1>
			<p>
				Some frameworks give you a solid set of classes, but little or no default
				project organization, leaving you to fend for yourself on each project you
				create, and spend time wiring up framework classes that should just work
				together. Others provide you with great organizational conventions, but no
				way to break out of those conventions if you need to, and too often, no way
				to override or replace core framework classes.
			</p>
			<p>
				li₃ is the first framework to give you the best of both worlds, without
				compromising either. In fact, the framework's API is intentionally designed to
				allow you to "grow out of" the framework and into your own custom code over
				the course of your application's lifecycle, if your needs require.
			</p>
		</article>

		<article>
			<h1 class="h-gamma">Technology</h1>
			<p>
				li₃ takes full advantage of the latest PHP language features, including
				namespaces, late static binding and closures. li₃'s innovative
				<?= $this->html->link('method filter system', [
					'library' => 'li3_docs',
					'controller' => 'Apis',
					'action' => 'view',
					'name' => 'lithium',
					'version' => '1.0.x',
					'symbol' => 'util\collection\Filters'
				]) ?>
				makes extensive use of closures and anonymous functions to
				allow application developers to "wrap" framework method calls, intercepting
				parameters before, and return values after.
			</p>
			<p>
				The framework also complies with PSR-4, the PHP namespacing standard, allowing you
				to easily integrate other PHP standard libraries and frameworks with
				your applications, and vice-versa.
			</p>
			<p>
				The framework integrates the latest storage technologies, including MongoDB,
				CouchDB and Redis, with plugin support for Cassandra, ElasticSearch and
				others.
			</p>
		</article>

		<article>
			<h1 class="h-gamma">Flexibility</h1>
			<p>
				li₃ gives you full control over your application, from filters to
				dynamically modify framework internals, to dynamic dependencies to extend
				and replace core classes with application or plugin classes, to heavy use
				of adapter-oriented configurations, to make it seamless to move between
				different technologies and options.
			</p>
			<p>
				Every component of the framework stack is replaceable through the
				robust plugin architecture. Swap out the default ORM / ODM implementation
				for
				<?= $this->html->link('Doctrine 2', 'https://github.com/mariano/li3_doctrine2/') ?>
				or
				<?= $this->html->link('PHP ActiveRecord', 'https://github.com/greut/li3_activerecord') ?>.
				Don't like the templating? Use
				<?= $this->html->link('Twig', 'https://github.com/UnionOfRAD/li3_twig') ?>,
				<?= $this->html->link('Mustache', 'https://github.com/bruensicke/li3_mustache') ?>,
				or roll your own.
			</p>
			<p>
				If you don't even need to write a full application, build a micro-app in a
				single file using the routing system, without giving up the maintainability
				of the framework's structure.
			</p>
		</article>
	</section>

	<section class="backers">
		<article class="creators">
			<div class="upper">
				<?= $this->html->link(
					$this->html->image('uor.png', ['class' => 'logo-uor']),
					'https://github.com/orgs/UnionOfRAD/people',
					['escape' => false, 'title' => 'Union of RAD']
				) ?>
			</div>
			<h1 class="h-gamma">Creators</h1>
		</article>

		<article class="sponsors">
			<div class="upper">
				<?= $this->html->link($this->html->image('logo_radify.png', ['class' => 'logo-radify', 'alt' => 'Radify']), 'http://radify.io', ['escape' => false]) ?>
				<?= $this->html->link($this->html->image('logo_atelierdisko.png', ['class' => 'logo-disko', 'alt' => 'Atelier Disko']), 'http://atelierdisko.de', ['escape' => false]) ?>
				<?= $this->html->link($this->html->image('logo_ey.png', ['class' => 'logo-ey', 'alt' => 'Engine Yard']), 'https://engineyard.com', ['escape' => false]) ?>
			</div>
			<h1 class="h-gamma">Sponsors</h1>
		</article>
	</section>

	<section class="define">
		<h1 class="h-gamma">Some Context</h1>
		<p>
			[…] a soft, silver-white metal belonging to the alkali metal group of chemical elements. Under standard conditions it is the lightest metal and the least dense solid element. Like all alkali metals, it is highly reactive and flammable.
		</p>
		–
		<p>
			In October 2009, CakePHP project manager
			<?= $this->html->link('Garrett Woodworth', 'https://twitter.com/gwoo') ?>
			and
			developer <?= $this->html->link('Nate Abele', 'https://twitter.com/nateabele') ?>
			resigned from the project to focus on
			li3, a framework code base originally being developed
			at the CakePHP project as Cake3.
		</p>
		<p>
			Together with
			<?= $this->html->link('Joël Perras', 'http://twitter.com/jperras'); ?>,
			<?= $this->html->link('Alexander Morland', 'http://twitter.com/alkemann'); ?>,
			<?= $this->html->link('David Persson', 'http://twitter.com/nperson'); ?>,
			<?= $this->html->link('Jon Adams', 'http://twitter.com/pointlessjon'); ?>,
			<?= $this->html->link('Mariano Iglesias', 'http://twitter.com/mgiglesias'); ?>,
			<?= $this->html->link('Jon Anderson', 'http://twitter.com/raisinbread'); ?>
			and
			<?= $this->html->link('Jeff Loiselle', 'http://twitter.com/phishy'); ?>
			they founded the Union of RAD.
			The Union of RAD
			is quite simply described as a community of developers dedicated to helping each other write better software.
		</p>
		<p>
			Over the years many many more excellent
			<?= $this->html->link('contributors', 'https://github.com/UnionOfRAD/lithium/graphs/contributors') ?>
			have joined the project, brought it further
			and keep it alive.
		</p>
		<p>
			In 2012 the project gained
			 official sponsorship from Engine Yard.
		</p>
		<p>
			In January 2014 the project underwent a rebranding effort during which it changed its name to <em>li3</em> which some pronounce [lith-ee-uh m].
		</p>
	</section>

	<hr class="section-separator darkblue">

	<section class="eureka">
		<?php echo $eureka->body() ?>
	</section>

	<hr class="section-separator lightblue">

	<section class="wild">
		<div class="upper">
		<?php foreach ($projects as $project): ?>
			<article class="project">
				<?= $this->html->link($project->title, $project->url, ['rel' => 'nofollow', 'class' => 'title']) ?>&nbsp;by&nbsp;<?= $this->html->link($project->author_name, $project->author_url, ['rel' => 'nofollow']) ?>
			</article>
		<?php endforeach ?>
		</div>
		<h1 class="h-gamma">In the Wild</h1>
		<p class="let-us-know">
			Are you using li3?
			<?= $this->html->link('Let us know.', '#submit-wild', ['class' => 'vis-toggler']) ?>
			<div id="submit-wild" class="hide">
				<p>
					If you want to have your project to be listed send an email with the subject li3 - in the wild to David Persson with the following details about your project:
					title, year the project launched, link to the project website, name of the author, link to the author's website (optional), name of the client, link to the client's website (optional).
				</p>
				<p>
					Both open and closed source projects are OK. We will be curating this list and thus it may be possible that your submission can not be included. We cannot include projects like libraries or plugins to li3 those are best found through the GitHub search.
					However we hope to include as many projects as possible and are happy about every submission.
				</p>
				<p>
					Note: By submitting your project you give Union of RAD the permission to publish it on this site. You also confirm that you have the rights to disclose the fact that li3 was used in building the project and that you have the rights to give us permission to publish its name.
				</p>
			</div>
		</p>
	</section>

	<div class="clearfix"></div>
</article>