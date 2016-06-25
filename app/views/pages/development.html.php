<?php

use lithium\core\Environment;

$this->set([
	'meta' => [
		'description' => 'This project is built by a thriving community of developers who value cutting-edge technology and concise, maintainable code. If you\'ve found a bug, or have an idea for a feature, we encourage your participation in making li3 better.'
	]
])

?>
<script>
function verifyCaptcha(token) {
	require(['jquery'], function($) {
		$.ajax({
			url: '/captcha/verify',
			type: 'POST',
			dataType: 'json',
			data: {
				token: token,
				entity: 'mail.security',
			}
		}).done(function(res) {
			var $mail = $('.secured .mail');
			var $captcha = $('.secured .captcha');

			if (res.status === 'success') {
				$mail.html(res.data.email);
				$captcha.remove();
			}
		});
	})
};
require(['jquery', 'recaptcha', 'domready!'], function($) {
	$('.secured .mail').on('click', function(ev) {
		ev.preventDefault();
		$('.secured .captcha').removeClass('hide');
	});
});
</script>
<article class="has-aside-right use-section-spacing">
	<h1 class="h-alpha"><?= $this->title('Development') ?></h1>

	<nav class="aside aside-right sticky">
		<h1 class="h-gamma">Contents</h1>
		<ul>
			<li><?= $this->html->link('Contributing', '#contributing') ?>
			<li><?= $this->html->link('Types of Contributions', '#types-of-contributions') ?>
			<ul>
				<li><?= $this->html->link('Enhancements', '#enhancements') ?>
				<li><?= $this->html->link('Bugs', '#bugs') ?>
				<li><?= $this->html->link('Security Vulnerabilities', '#security') ?>
				<li><?= $this->html->link('Documentation', '#documentation') ?>
			</ul>
			<li><?= $this->html->link('Branching', '#branching') ?>
			<li><?= $this->html->link('Specifications', '#specs') ?>
		</ul>
	</nav>

	<section id="contributing">
		<h1 class="h-beta">Contributing</h1>
		<p>
			Thank you for your interest in contributing to the project! It is
			built by a thriving community of developers who value cutting-edge technology
			and concise, maintainable code. If you've found a bug, or have an idea for a
			feature, we encourage your participation in making the framework better.
		</p>

		<article id="tldr">
			<h1 class="h-gamma">tl;dr</h1>
			<p>
				<em>In a hurry? Here's what you need to stick to in order to
				have the best chance of getting your code pushed to the core:</em>
			</p>

			<ul>
				<li><strong>Conceptual integrity</strong>:
				code should conform to the goals of the framework

				<li><strong>Maintainability</strong>:
				code should pass existing
				<?= $this->html->link('tests', 'http://li3.me/docs/specs/accepted/LSR-2-testing.md') ?>,
				have adequate test coverage and should conform to our
				<?= $this->html->link('coding standards', 'http://li3.me/docs/specs/accepted/LSR-0-coding.md') ?>

				<li><strong>Comprehensibility</strong>:
				code should be concise and expressive, and should be accompanied by new
				<?= $this->html->link('documentation', 'http://li3.me/docs/specs/accepted/LSR-1-documenting.md') ?>
				as appropriate, or updates to existing docs

				<li><strong>Integration</strong>:
				finally, pull requests should be submitted against their respective version
				branch. The following 3 rules help, to determine the correct version branch.
				<ol>
					<li>Patches for bug fixes against <em>next stable</em> (i.e. 1.0).
					<li>Patches for BC-features against <em>next minor</em>. (i.e. 1.1)
					<li>Patches for BC-breaking-features against <em>next major</em>. (i.e. 2.0)
				</ol>
			</ul>
		</article>

		<hr class="section-separator red">

		<article id="types-of-contributions">
			<h1 class="h-gamma">Types of Contributions</h1>

			<p>
				Whatever you'd like to contribute to the project, you may wish to discuss it with the core team and development community before beginning your work. <a href="https://github.com/UnionOfRAD/lithium/issues/new">Open an appropriately-labeled issue</a> in GitHub.
			</p>

			<p>We value collaboration and believe that the best solutions are usually found through use-case-oriented discussions and—occasionally—some healthy debate. If you have an idea for a killer feature or think you've found a bug, please talk it over with a seasoned member of the team.</p>

			<p>Combining great new ideas with the wisdom of experience will help us create the best possible features for the framework.  Likewise, talking through a bug with a core team member will help us ensure the best possible fix.  We're striving to maintain a lean, clean core and want to avoid introducing patches for symptoms of an underlying flaw.</p>

			<hr class="section-separator">

			<article id="enhancements">
				<h1 class="h-delta">Enhancements and New Features</h1>

				<p>One of li3's key goals is a light, clean core, which means careful consideration of new features. Here are some of the criteria we go by when deciding whether or not to incorporate a new feature into the framework:<br><br></p>

				<ul>
					<li><strong>Does it fit within the existing set of features?</strong> Lots of features are great ideas in their own right, but might not be right for integration with the core itself. Examples include wholly new pieces of functionality that could easily fit within a plugin, or adapters for technologies that aren't widely used.<br><br>Often, even in cases where integration for a widely-used technology might otherwise make an obvious addition, we choose to keep things in plugins in order to ensure the core always stays as light as possible. Every new feature introduced has a permanent cost in terms of maintenance and documentation, increases testing burden and couples additional code to every release cycle.</li>
					<li><strong>Is the feature not easily replicated with a few lines of app code?</strong> Sometimes it's tempting to implement a new option flag or class property that makes your application code a little more convenient in a small subset of cases, but a lack of careful editing leads not only to high maintenance overhead, but to a lack of long-term flexibility in evolving the API. The framework is designed to be modular and extensible, and should be treated as such.<br><br>If there's enough code to justify a plugin, publish it as such. Many times, features that don't make the cut in one version are implemented as plugins which gain wide acceptance, and are integrated into the core in subsequent versions.</li>
				</ul>

				<p>If your idea passes these two basic tests, it's time to engage a core team member to get started on the idea. Every new feature is handled differently, but the basic workflow usually ends up playing out something like this:</p>

				<ol>
					<li>Contacting a core team member via email, or GitHub issue ticket</li>
					<li>Use-case oriented discussions (complete with healthy debate!)</li>
					<li>Initial implementation, often in a pre-identified branch or fork</li>
					<li>Test case and documentation development (or updates)</li>
					<li>Code review and merge into mainline</li>
				</ol>
			</article>
			<article id="bugs">
				<h1 class="h-delta">Bugs</h1>

				<p>Helping to fix bugs is a huge help to the core team, who is often burdened with more they can already handle. Fixing existing issues is also a great way to free up core team time for adding new feaures!</p>

				<p>Helping with bugs follows the same 5-step process outlined above: just be sure to check in with someone on the core team to understand how to best help. This will make sure that you're working on bugs that have a high-priority and aren't being investigated by anyone else.</p>

				<p>If you're looking to report an issue, there are a few things you'll want to consider before submitting an issue on one of our GitHub repos:</p>

				<ul>
					<li>Make sure you're using the latest code. It's possible your issue is already fixed! </li>
					<li>Search the issues list to make sure the problem hasn't already been reported.</li>
					<li>Add a descriptive title and summary. Phrases like "doesn't work" aren't really helpful without lots of supporting details.</li>
					<li>Submit a test case with the issue. This helps us both reproduce the issue and also verify possible fixes.</li>
				</ul>

				<p>Above all, remember that <em>volunteers</em> are going to be responding to these requests for help. Politeness and respect go a long ways, as do humor, preventative research, and bribery.</p>
			</article>
			<article id="security">
				<h1 class="h-delta">Security Vulnerabilities</h1>

				<p>
					Security vulnerabilities are an especially sensitive class
					of bug and <strong>should be confidentially reported directly</strong> to
					the following email address:
				</p>

				<div class="secured">
					<strong><a href="#" class="mail">secu…@… (click to show)</a></strong>
					<div
						class="g-recaptcha captcha hide"
						data-sitekey="<?= Environment::get('service.recaptcha.siteKey') ?>"
						data-callback="verifyCaptcha"
					></div>
				</div>

				<p>
					<strong>Please do not disclose any details publicly.</strong> When reporting security vulnerabilities, please
					specify the version affected, include relevant reproduction code along with any other pertinent
					information relevant to addressing the vulnerability, such as 3rd-party software or components,
					etc.
				</p>

				<p>On reporting a confirmed security vulnerability, you can expect to receive a response from a core team member within 24 hours containing next steps as well as any follow-up questions necessary to produce a patch and publish a security update.</p>
			</article>
			<article id="documentation">
				<h1 class="h-delta">Documentation</h1>

				<p>li3 documentation is an ongoing work, and we need your help. li3 users <em>new</em> and <em>old</em> are welcome and encouraged to join in the fun. If you've struggled with something, help us record and share the solution so others can find the way more easily. There are many ways you can help:</p>

				<ul>
					<li>Code examples to enrich current documentation</li>
					<li>Creation of lists or tables to help explain concepts</li>
					<li>Rough notes that describe an oft-used process</li>
					<li>Corrections (typos, inaccuracies, etc.)</li>
					<li>Translations</li>
				</ul>

				<p>If you'd like to help, simply <a href="https://github.com/UnionOfRAD/manual">fork the project on GitHub</a>, <a href="https://github.com/UnionOfRAD/manual/issues">open a new pull request</a> and get in contact with one of the core team members.</p>
			</article>
		</article>

		<hr class="section-separator lightblue">

		<article id="branching">
			<h1 class="h-gamma">Branching</h1>

			<p>The li3 core is managed on a very simple branching workflow: when developing new features or bug fixes, a topic branch with a relevant name is created, such as <code>new-media-encode</code> or <code>model-find-fix</code>. Using comprehensible branch names helps us make sense of the source history as branches are merged.</p>

			<p>Once commits on a topic branch have been verified through testing, are properly documented and pass our QA checks, the topic branch will be merged into the <code>dev</code> integration branch. Ordinarily, you'll want to point your pull requests at this branch.</p>

			<p>For long-running feature branches, like <code>data</code>, you can point relevant pull requests there instead.</p>
		</article>
	</section>

	<hr class="section-separator lightblue">

	<section id="specs">
		<h1 class="h-beta">Standard Specifications</h1>
		<p>
			Standard <?= $this->html->link('Specifications', [
				'library' => 'li3_docs', 'action' => 'view', 'controller' => 'Books', 'name' => 'specs', 'version' => '1.x'
			]) ?> (or <em>specs</em> for short) help us take li3 further.
			li3 adheres to several standards, created by the PHP Framework Interoperability
			Group (i.e. PSR-0) as well as the li3 Community.
		</p>
	</section>
<!--
	<section id="more">
		<h1 class="h-beta">More</h1>
		<ul>
			<li><a href="/UnionOfRAD/lithium/wiki/Roadmap">Roadmap</a></li>
			<li><a href="https://github.com/UnionOfRAD/lithium/graphs/contributors">Contributors</a></li>
			<li><a href="/UnionOfRAD/lithium/wiki/Editors">Editors</a></li>
			<li><a href="/UnionOfRAD/lithium/wiki/Benchmarking">Benchmarking</a></li>
			<li><a href="/UnionOfRAD/lithium/wiki/Translation-Tools">Translation Tools</a></li>
		</ul>
	</section>
-->
</article>