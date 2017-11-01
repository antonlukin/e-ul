<?php
/**
 * E-ul: Ulyanovsk multifunctional center promo website
 *
 * @copyright   Copyright (c) 2017, Anton Lukin <anton@lukin.me>
 * @license     MIT, https://github.com/antonlukin/e-ul/LICENSE
 */


namespace app\models;

use Flight as app;


class header {
	public $options = null;

	public function __construct($options = []) {
		$this->options = $options;
	}

	public function render() {
		app::render('modules/header', ['title' => 'Title']);
	}
}
