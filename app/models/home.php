<?php
/**
 * E-ul: Ulyanovsk multifunctional center promo website
 *
 * @copyright   Copyright (c) 2017, Anton Lukin <anton@lukin.me>
 * @license     MIT, https://github.com/antonlukin/e-ul/LICENSE
 */


namespace app\models;

use Flight as app;


class home {
	public function __construct() {

	}

	public function render($route) {
		app::render('regions/home');
	}
}
