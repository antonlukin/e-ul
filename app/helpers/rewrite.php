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
 * Rewrite class
 *
 * Set routers with Flight app
 *
 * @since 1.0
 */
class rewrite {

	public function __construct() {
		$rules = app::get("app.controllers");

		// Load all availible routes
		$this->load($rules);
	}

	public function load($endpoints) {
		foreach($endpoints as $endpoint) {
			$rule = "\\app\\routes\\$endpoint";

			(new $rule)->init();
		}
	}

}
