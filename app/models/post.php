<?php
/**
 * E-ul: Ulyanovsk multifunctional center promo website
 *
 * @copyright   Copyright (c) 2017, Anton Lukin <anton@lukin.me>
 * @license     MIT, https://github.com/antonlukin/e-ul/LICENSE
 */


namespace app\models;

use Flight as app;


class single {
	public function __construct() {

	}

	public function post() {
		app::render('views/home');
	}

	public function page() {
	}
}
