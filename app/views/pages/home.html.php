<?php

use textual\Modulation as Textual;

$this->title('Lithium is the most RAD development framework for PHP 5.3 and up')

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
			<h2 class="h-beta">Lithium is the fast, flexible and most RAD development framework for PHP 5.3 and up.</h1>
			<nav>
				<?= $this->html->link('Quickstart', ['library' => 'li3_docs', 'action' => 'view', 'controller' => 'ApiBrowser', 'lib' => 'manual', 'args' => ['quickstart']], ['class' => 'button large']) ?>
				<?= $this->html->link('Source', 'https://github.com/unionofrad/lithium', ['class' => 'button large']) ?>
			</nav>
		</div>
	</section>

	<?php if ($posts): ?>
	<section class="latest-posts">
		<?php foreach ($posts as $post): ?>
			<article class="post-item">
				<h1 class="h-gamma"><?= $this->html->link($post->title, $post->post_url) ?></h1>
				<time><?= date('m/d/Y', $post->timestamp) ?></time>
				<div class="body">
					<?php echo Textual::limit($post->body, 400, ['html' => true]) ?>
					[<?= $this->html->link('read more…', $post->post_url, ['class' => 'read-more']) ?>]
				</div>
			</article>
		<?php endforeach ?>
	</section>
	<hr class="section-separator lightblue">
	<?php endif ?>


	<section class="features">
		<h1 class="h-alpha">What is Lithium?</h1>
		<article>
			<h1 class="h-gamma">A framework of firsts</h1>
			<p>
				Lithium is the first and only major PHP framework built from
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
				Lithium is the first framework to give you the best of both worlds, without
				compromising either. In fact, Lithium's API is intentionally designed to
				allow you to "grow out of" the framework and into your own custom code over
				the course of your application's lifecycle, if your needs require.
			</p>
		</article>

		<article>
			<h1 class="h-gamma">Technology</h1>
			<p>
				Lithium takes full advantage of the latest PHP 5.3 features, including
				namespaces, late static binding and closures. Lithium's innovative
				<?= $this->html->link('method filter system', [
					'library' => 'li3_docs', 'action' => 'view', 'controller' => 'ApiBrowser',
					'lib' => 'lithium', 'args' => ['util/collection/Filters']
				]) ?>
				makes extensive use of closures and anonymous functions to
				allow application developers to "wrap" framework method calls, intercepting
				parameters before, and return values after.
			</p>
			<p>
				Lithium also complies with PSR-0, the PHP 5.3 namespacing standard, allowing you
				to easily integrate other PHP 5.3 standard libraries and frameworks with
				Lithium applications, and vice-versa.
			</p>
			<p>
				Lithium integrates the latest storage technologies, including MongoDB,
				CouchDB and Redis, with plugin support for Cassandra, ElasticSearch and
				others.
			</p>
		</article>

		<article>
			<h1 class="h-gamma">Flexibility</h1>
			<p>
				Lithium gives you full control over your application, from filters to
				dynamically modify framework internals, to dynamic dependencies to extend
				and replace core classes with application or plugin classes, to heavy use
				of adapter-oriented configurations, to make it seamless to move between
				different technologies and options.
			</p>
			<p>
				Every component of the Lithium framework stack is replaceable through the
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
				<?= $this->html->link($this->html->image('uor.png', ['class' => 'logo-uor']), 'https://github.com/UnionOfRAD', ['escape' => false, 'title' => 'Union of RAD']) ?>
				<div class="and">+</div>
				<div class="you">you</div>
			</div>
			<h1 class="h-gamma">Creators</h1>
		</article>

		<article class="sponsors">
			<div class="upper">
				<?= $this->html->link($this->html->image('logo_radify.png', ['class' => 'logo-radify']), 'http://radify.io', ['escape' => false, 'alt' => 'Radify']) ?>
				<?= $this->html->link($this->html->image('logo_atelierdisko.png', ['class' => 'logo-disko']), 'http://atelierdisko.de', ['escape' => false, 'alt' => 'Atelier Disko']) ?>
				<?= $this->html->link($this->html->image('logo_ey.png', ['class' => 'logo-ey']), 'https://engineyard.com', ['escape' => false, 'Engine Yard']) ?>
			</div>
			<h1 class="h-gamma">Sponsors</h1>
		</article>
	</section>

	<section class="define">
		<h1 class="h-gamma">Some Context</h1>
		<p>
			As defined by Wikipedia is
			Lithium (from Greek: λίθος lithos, "stone") a soft, silver-white metal belonging to the alkali metal group of chemical elements. Under standard conditions it is the lightest metal and the least dense solid element. Like all alkali metals, lithium is highly reactive and flammable.
		</p>
		–
		<p>
			In October 2009, CakePHP project manager
			<?= $this->html->link('Garrett Woodworth', 'https://twitter.com/gwoo') ?>
			and
			developer <?= $this->html->link('Nate Abele', 'https://twitter.com/nateabele') ?>
			resigned from the project to focus on
			Lithium, a framework code base originally being developed
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
			Since then many many more excellent
			<?= $this->html->link('contributors', 'https://github.com/UnionOfRAD/lithium/graphs/contributors') ?>
			have joined the project, brought it further
			and keep it alive.
		</p>
		<p>
			In 2012 the project gained
			 official sponsorship from Engine Yard.
		</p>
		<p>
			The name <em>Lithium</em> with its atomic number 3 has originally been chosen following up on the former name
			<em>Cake3</em>. In January 2014 the project changed its name from <em>Lithium</em> to
			<em>li3</em> which still is pronounced [lith-ee-uh m].
		</p>
	</section>

	<hr class="section-separator darkblue">

	<section class="eureka">
		<h1 class="h-gamma">Eureka Moment</h1>
		<div>
			<?php echo $eureka->body() ?>
		</div>
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
	</section>

	<div class="clearfix"></div>
</article>