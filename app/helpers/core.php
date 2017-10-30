<?php
/**
 * E-ul: Ulyanovsk multifunctional center promo website
 *
 * @copyright   Copyright (c) 2017, Anton Lukin <anton@lukin.me>
 * @license     MIT, https://github.com/antonlukin/e-ul/LICENSE
 */


namespace app\helpers;

use Flight as app;


class core {
	public function __construct($base) {
		/**
		* We use Flight framework as engine
		*
		* @link https://github.com/mikecao/flight
		* @since 1.0
		*/

	}

	public function load() {

		app::route('/', function(){
			echo '1';
		});

		app::start();

	}
}
