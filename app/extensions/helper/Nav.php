<?php
/**
 * Nav Helper
 *
 * Copyright (c) 2009-2014 David Persson - All rights reserved.
 *
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 */

namespace app\extensions\helper;

/**
 * Nav Helper to generate navigation elements.
 */
class Nav extends \lithium\template\Helper {

	const COMPLETE_MATCH = 10;
	const PARTIAL_MATCH = 5;
	const PARTIAL_MISMATCH = -5;
	const COMPLETE_MISMATCH = -10;

	/**
	 * Holds a multi-dimensional array of navigation items. First keyed by section holding
	 * an array of items belonging to that section.
	 *
	 * @var array
	 */
	protected $_items = [];

	/**
	 * Generates a HTML element for accessibility purposes. Must be combined
	 * with CSS to achieve effect.
	 *
	 * @param string $to ID of element to skip to, defaults to `'content'`.
	 * @return string HTML
	 */
	public function skip($to = 'content') {
		$html  = '<p class="hide">';
		$html .= $this->_context->html->link('Skip navigation.', "#{$to}");
		$html .= '</p>';

		return $html;
	}

	/**
	 * Adds a navigation item to a section.
	 */
	public function add($section, $title, $url = null, array $options = []) {
		if (is_array($title)) {
			foreach($title as $item) {
				$this->add($section, $item['title'], $item['url'], (array) $url);
			}
			return null;
		}
		if (!$url) {
			$url = $title;
		}
		$default = [
			'id' => null,
			'class' => null,
			'escape' => true,
			'active' => null,
			'title' => null,
			'rel' => null,
			'target' => null
		];
		$options = array_merge($default, $options);
		$this->_items[$section][] = [
			'link' => [
				'rel' => $options['rel'],
				'target' => $options['target']
			],
			'title' => $title,
			'url' => $url,
			'id' => $options['id'],
			'class' => $options['class'],
			'escape' => $options['escape'],
			'active' => $options['active'],
			'_title' => $options['title'] // This obviously is a hack :)
		];
	}

	/**
	 * Generates a navigation for given section.
	 *
	 * @param string $section The navigation section.
	 * @param array $options Available options are:
	 *              - `'match'` _string_: Allows you to pick a matching algorithm
	 *                for this section. The algorithm determines which item will
	 *                be set active. Possible values are `'strict'`, `'loose'`, `'diff'`
	 *                and `'option'`. Defaults to `'option'`.
	 * @param array $items
	 * @return string HTML
	 */
	public function generate($section, $options = [], array $items = []) {
		$default = [
			'match' => 'option',
			'reset' => false,
			'class' => null,
			'tag' => 'nav',
			'itemTag' => null,
			'id' => null
		];
		$options += $default;
		$out = null;

		if (empty($items)) {
			if (!isset($this->_items[$section])) {
				return null;
			}
			$items = $this->_items[$section];
		}

		$active = ['key' => null, 'match' => null];

		foreach ($items as $key => &$item) {
			$url = $this->_context->url($item['url']);
			$url = strtok($url, '?');

			switch ($options['match']) {
				case 'contain':
				case 'loose':
					$url = strtok($url, ':');
				case 'strict':
					$match = $this->_matchContain($url, $this->_context->request()->url);

					if ($options['match'] === 'strict') {
						$requireMatch = self::COMPLETE_MATCH;
					} else {
						$requireMatch = self::PARTIAL_MATCH;
					}
					if ($match >= $requireMatch || ($match > $active['match'] && $active['match'])) {
						$active = ['key' => $key, 'match' => $match];
					}
					break;
				case 'diff':
					$count = $this->_countDiffUrls($url, $this->_context->request()->url);

					if ($count < $active['match'] || $active['match']) {
						$active = ['key' => $key, 'match' => $count];
					}
					break;
				case 'option':
					if ($item['active']) {
						$active = ['key' => $key, 'match' => true];
					}
					break;
			}
		}
		unset($item);

		if (isset($active['key'])) {
			$items[$active['key']]['active'] = true;
		}

		/* Format */
		$out = null;
		foreach ($items as $item) {
			$linkOptions = array_filter([
				'escape' => $item['escape'],
				'title' => $item['_title']
			]) + array_filter($item['link']);

			if ($options['itemTag']) {
				$ItemAttributes = array_filter([
					'class' => $item['class'],
					'id' => $item['id']
				]);

				if ($item['active']) {
					if (isset($attributes['class'])) {
						$attributes['class'] .= ' active';
					} else {
						$attributes['class'] = 'active';
					}
				}
				$attributes = $this->_attributes($attributes);
				$out .= "<{$options['itemTag']}{$attributes}>";
				$out .= $this->_context->html->link($item['title'], $item['url'], $linkOptions);
				$out .= "</{$options['itemTag']}>";
			} else {
				$attributes = array_filter([
					'class' => $item['class']
				] + $linkOptions);

				if ($item['active']) {
					if (isset($attributes['class'])) {
						$attributes['class'] .= ' active';
					} else {
						$attributes['class'] = 'active';
					}
				}
				$out .= $this->_context->html->link($item['title'], $item['url'], $attributes);
			}
		}

		if ($options['reset']) {
			unset($this->_items[$section]);
		}

		if ($options['tag']) {
			$attributes = $this->_attributes(array_filter([
				'class' => $options['class'],
				'id' => $options['id']
			]));
			$html  = "<{$options['tag']}{$attributes}>";
			$html .= $out;
			$html .= "</{$options['tag']}>";

			return $html;
		} else {
			return $out;
		}
	}

	public function instant($title, $url, $options = []) {
		$options = array_merge(['tag' => false, 'itemTag' => false], $options);

		$item = [
			'title' => $title,
			'url' => $url,
			'class' => null
		];
		return $this->generate(null, $options, [$item]);
	}

	protected function _matchContain($subject, $object) {
		if (empty($subject)) {
			return self::COMPLETE_MISMATCH;
		}
		if ($subject === $object) {
			return self::COMPLETE_MATCH;
		}

		$matchPosition = strpos($object, $subject);

		if ($matchPosition === 0) {
			return self::PARTIAL_MATCH;
		}
		if ($matchPosition === false) {
			return self::COMPLETE_MISMATCH;
		}
		return self::PARTIAL_MISMATCH;
	}

	protected function _matchDiff($subject, $object) {
		return count(array_diff_assoc(explode('/', $subject), explode('/', $object)));
	}
}

?>