<article class="use-section-spacing">
	<h1 class="h-alpha"><?= $this->title('Participate') ?></h1>

	<nav class="aside aside-right sticky">
		<h1 class="h-gamma">Contents</h1>
		<ul>
			<li><?= $this->html->link('Get Help', '#get-help') ?>
			<ul>
				<li><?= $this->html->link('IRC', '#irc') ?>
				<li><?= $this->html->link('Stack Overflow', '#so') ?>
				<li><?= $this->html->link('Issue Tracker', '#issues') ?>
			</ul>
			<li><?= $this->html->link('Elsewhere', '#elsewhere') ?>
			<li><?= $this->html->link('Community Run Projects', '#community-run') ?>
			<li><?= $this->html->link('Community Guidelines', '#guidelines') ?>
	</nav>


	<section>
		<p>
			li3 is not just a framework, but the embodiment of a community. This
			community is dedicated to open collaboration and friendly discourse, with
			the goal of producing better quality software.
		</p>
		<p>
			Most importantly, you are invited to <em>participate</em>. As with any
			communities there are some rules and conventions. In order for everyone
			to have a productive and positive experience, we ask that every member
			familiarizes themselves with the <a href="#guidelines">guidelines</a> below. We do not want to have
			to tell you what would happen if the guidelines are not followed. ;-)
		</p>
	</section>
	<?= $this->html->image('/ico/network.png', ['width' => 400]) ?>

	<hr class="section-separator">

	<section id="get-help">
		<h1 class="h-beta">Get Help</h1>
		<article id="irc">
			<h1 class="h-gamma">IRC</h1>
			<p>
				Currently the fastest way to get in contact with the
				core developers and the community as a whole is through IRC, on the
				<code>irc.freenode.net</code> server. There you can join the #li3
				channel. We suggest to use an IRC client or alternatively
				<a href="http://webchat.freenode.net/">Freenode's Webchat interface</a>.
				Please note that anything more than one line of code should not be
				put in the IRC channel. For longer code snippets instead use
				<a href="https://gist.github.com">Gists</a>.
			</p>
			<p>
				<code>#li3</code> on freenode
				- <em>General discussion and support questions.</em>
				- <?= $this->html->link('logs', [
					'controller' => 'logs', 'library' => 'li3_bot',
					'action' => 'index', 'channel' => 'li3'
				]) ?>
			</p>
			<p></p>
		</article>

		<article id="so">
			<h1 class="h-gamma"><a href="http://stackoverflow.com/questions/tagged/lithium">Stack Overflow</a></h1>
			<p>
				With over 200 questions already tagged, ask yours on
				<a href="http://stackoverflow.com/questions/tagged/lithium">stackoverflow.com</a>
				and <a href="http://stackoverflow.com/questions/tagged/lithium">use the
				<em>lithium</em> tag</a>.
			</p>
		</article>

		<article id="issues">
			<h1 class="h-gamma"><a href="https://github.com/UnionOfRAD/lithium/issues">GitHub Issue Tracker</a></h1>
			<p>
				Although not dedicated for support questions you may find the discussions
				happening on pull requests and tickets in the <a href="https://github.com/UnionOfRAD/lithium/issues">issue tracker</a> helpful.
			</p>
		</article>
	</section>

	<hr class="section-separator lightblue">

	<section id="elsewhere">
		<h1 class="h-beta">Elsewhere</h1>
		<ul>
			<li><a href="https://twitter.com/#!/UnionOfRAD">Union of RAD on Twitter</a></li>
			<li><a href="https://twitter.com/#!/search?q=%23li3">Follow the #li3 hashtag on Twitter</a></li>
			<li><a href="https://twitter.com/#!/UnionOfRAD/lithium">Union of RAD's li3 List</a></li>
			<li><a href="http://www.reddit.com/r/li3/">Official li3 Reddit</a></li>
			<li><a href="http://www.last.fm/group/li3">Official li3 last.fm group</a></li>
			<li><a href="http://www.meetup.com/lithium/">li3 meetup group</a></li>
		</ul>
	</section>

	<hr class="section-separator darkblue">

	<section id="community-run">
		<h1 class="h-beta">Community-Run Projects</h1>
		<p>
			Make sure to bookmark
			<strong><?= $this->html->link('Lithium101', 'http://lithium101.com/', array('rel' => 'nofollow')) ?></strong>
			an unofficial community resource for the li3 PHP framework indexing articles, tutorials, code snippets and libraries.
		</p>
	</section>

	<hr class="section-separator red">

	<section id="guidelines">
		<h1 class="h-beta">Community Guidelines</h1>
		<div class="body">
			<p>
				We deem these rules to be self evident, that all developers are created equal...please follow them in good faith. We'll all have a bit more radness as a result.
			</p>
			<h2 class="h-gamma">Respect</h2>
			<p>
				We all have day jobs, but we also enjoying helping others. <em>Respect each
				other's time and ideas</em>. Try to give back more than you take.
			</p>
			<h2 class="h-gamma">Friendliness</h2>
			<p>
				Keeping a healthy attitude and friendly atmosphere will make the experience
				enjoyable for all and will make sure that the people who are willing to
				spend time helping others are not driven away.
			</p>
			<h2 class="h-gamma">Focus</h2>
			<p>
				Staying on topic will make sure that the discussion remains fruitful for
				everyone and reduces the effort of finding useful information.
			</p>
			<h2 class="h-gamma">Questions</h2>
			<p>
				Be in the right place and direct questions at the group. Everyone is here
				to help, so only talk to an individual when you have already engaged them
				in the conversation. Private messages should only be used as a last resort.
			</p>
		</div>
	</section>

</article>