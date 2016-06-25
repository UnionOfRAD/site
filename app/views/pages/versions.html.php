<?php

use lithium\core\Environment;

$this->set([
	'meta' => [
		'description' => 'Version planning, with compatibility table and schedule.'
	]
])

?>
<article class="use-section-spacing">
	<h1 class="h-alpha"><?= $this->title('Versions') ?></h1>

	<section>
		<h2 class="h-beta">Release History</h2>
		<p>
		For downloads and changelogs see the <?= $this->html->link('GitHub Releases Page', 'https://github.com/UnionOfRAD/lithium/releases', [
		]) ?>.
		</p>
	</section>
	<section>
		<h2 class="h-beta">Compatibility</h2>
		<p>
			Because the framework takes advantage of advanced language features, a recent PHP version
			is required. The compatibility table below shows which framework version requires which PHP
			version.
		</p>
		<p>
			Beginning with the 1.0.0 release we'll be using <a href="http://semver.org">SemVer</a> for
			versioning. We don't consider changes in the requirement of PHP versions a BC Break, as
			long as the PHP version changes only in its minor.
		</p>

		<table>
			<thead>
				<tr>
					<th>
					<th>required PHP
					<th>recommended PHP
			</thead>
			<tbody>
		<?php foreach ($data as $item): ?>
				<tr>
					<th><?= $item->name ?>
					<td><?= $item->required ?>
					<td><?= $item->recommended ?>
		<?php endforeach ?>
			</tbody>
		</table>
	</section>

	<section>
		<h2 class="h-beta">Supported Versions Schedule</h2>
		<p>
			Subject to changes, especially for things in the far future.
			There will be an absolute minimum of 1 year support for each version.
			Heavily used versions can get an extended lifetime. Still the overall
			goal here is, allowing to evolve quick enough to keep up with changes
			in the ecosystem.
		</p>
		<table class="supported-versions-table">
			<thead>
				<tr>
					<td>
					<td colspan="2">2014
					<td colspan="2">2015
					<td colspan="2">2016
					<td colspan="2">2017
					<td colspan="2">2018
					<td colspan="2">2019
					<td colspan="2">2020
					<td colspan="2">2021
			</thead>
			<tbody>
				<tr>
					<td>0.11
					<td colspan="2" class="sv--live">
					<td colspan="2" class="sv--sec">
				<tr>
					<td>1.0
					<td colspan="4" class="sv--pre">
					<td colspan="3" class="sv--live">
					<td colspan="1" class="sv--sec">
				<tr>
					<td>1.1
					<td colspan="3">
					<td colspan="3" class="sv--pre">
					<td colspan="2" class="sv--live">
					<td colspan="1" class="sv--sec">
				<tr>
					<td>1.2
					<td colspan="6">
					<td colspan="2" class="sv--pre">
					<td colspan="2" class="sv--live">
					<td colspan="1" class="sv--sec">
				<tr>
					<td>2.0
					<td colspan="8">
					<td colspan="2" class="sv--pre">
					<td colspan="3" class="sv--live">
					<td colspan="1" class="sv--sec">
			</tbody>
			<tfoot>
				<tr>
					<td class="sv--pre">
					<td colspan="6">
						&nbsp;pre release phase
				<tr>
					<td class="sv--live">
					<td colspan="6">
						&nbsp;active support
				<tr>
					<td class="sv--sec">
					<td colspan="6">
						&nbsp;security fixes only
			</tfoot>
		</table>
	</section>
</article>