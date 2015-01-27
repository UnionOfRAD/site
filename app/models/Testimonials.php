<?php

namespace app\models;

class Testimonials extends \lithium\data\Model {

	protected $_meta = array(
		'connection' => false
	);

	public static function random() {
		$data = static::_data();
		return $data[abs(crc32(date('Y-m-d'))) % count($data)];
	}

	protected static function _data() {
		$data = [];

		$data[] = [
			'url' => '/img/testimonials/0.png',
			'body' => "I wouldn't use it, but…\nit's pretty rad."
		];
		$data[] = [
			'url' => '/img/testimonials/1.png',
			'body' => "This will fit excellently\ninto my very evil plan.",

		];
		$data[] = [
			'url' => '/img/testimonials/2.png',
			'body' => "Not sure what those other
guys were talking about but –
hey can you guys be quiet?
I have the microphone. It's my
turn to talk. What? No, you can
grab a snack after I am done…",
		];
		$data[] = [
			'url' => '/img/testimonials/3.png',
			'body' => "I don't look at it directly\nout of respect.",
		];
		$data[] = [
			'url' => '/img/testimonials/4.png',
			'body' => '– no comment –',
		];
		$data[] = [
			'url' => '/img/testimonials/5.png',
			'body' => "Be your own giant,\nwith an un–giant framework.",

		];
		$data[] = [
			'url' => '/img/testimonials/6.png',
			'body' => "You see this? I'm giving li3\nthe thumbs up and pointing at you.\nAt the same time.",
		];
		$data[] = [
			'url' => '/img/testimonials/7.png',
			'body' => "I'm sorry.\nThis is beyond me.",
		];
		$data[] = [
			'url' => '/img/testimonials/8.png',
			'body' => 'Resistance is futile.',
		];
		$data[] = [
			'url' => '/img/testimonials/9.png',
			'body' => "It looks like you're
trying to build an
application with a
badass framework
for PHP.

May I suggest:
- Using li3",
		];
		$data[] = [
			'url' => '/img/testimonials/10.png',
			'body' => "I think it's time you started\nwriting better code.",
		];
		$data[] = [
			'url' => '/img/testimonials/11.png',
			'body' => "[compelling statement]",
		];
		// 12 skipped
		$data[] = [
			'url' => '/img/testimonials/13.png',
			'body' => "NERDS!?!",
		];
		$data[] = [
			'url' => '/img/testimonials/14.png',
			'body' => 'The cak3 is a li3.',
		];
		$data[] = [
			'url' => '/img/testimonials/15.png',
			'body' => "There is a framework for that.",
		];
		$data[] = [
			'url' => '/img/testimonials/16.png',
			'body' => "We welcome our li3 overlords!",
		];
		$data[] = [
			'url' => '/img/testimonials/17.png',
			'body' => "With li3, I don't need to\nreverse the polarity of the neutron flow…",
		];
		$data[] = [
			'url' => '/img/testimonials/18.png',
			'body' => 'What is its cloud strategy?',
		];
		$data[] = [
			'url' => '/img/testimonials/19.png',
			'body' => "…",
		];
		$data[] = [
			'url' => '/img/testimonials/20.png',
			'body' => "According to legend…\nli3 holds the secret to ultimate ninja power."
		];
		return $data;
	}
}

?>