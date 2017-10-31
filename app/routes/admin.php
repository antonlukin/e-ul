<?php
/**
 * E-ul: Ulyanovsk multifunctional center promo website
 *
 * @copyright   Copyright (c) 2017, Anton Lukin <anton@lukin.me>
 * @license     MIT, https://github.com/antonlukin/e-ul/LICENSE
 */

namespace app\routes;

use Flight as app;

class admin {
	public function init() {
		app::route('/admin', function() {
			echo 'admin';
		});
	}
}

