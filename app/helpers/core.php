<?php
/**
 * E-ul: Ulyanovsk multifunctional center promo website
 *
 * @copyright   Copyright (c) 2017, Anton Lukin <anton@lukin.me>
 * @license     MIT, https://github.com/antonlukin/e-ul/LICENSE
 */


namespace app\helpers;

use Flight as app;

/**
 * Application core loader
 *
 * Init all nested routers and classes and set required variables
 * using Flight framework ({@link https://github.com/mikecao/flight}) as engine
 *
 * @since 1.0
 */
class core {

	public function __construct($base) {
		app::set('base', $base);
	}

	public function load() {

		app::route('/', function(){
			echo '1';
		});

		app::start();

	}
}
