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
 * DB init class
 *
 * A simple database toolkit for PHP Sparrow
 * ({@link https://github.com/mikecao/sparrow})
 *
 * @since 1.0
 */
class database {

	public function __construct() {
		$args = [
			'type' => app::env("DB_TYPE", "mysqli"),
			'port' => app::env("DB_PORT", 3306),
			'hostname' => app::env("DB_HOSTNAME", "localhost"),
			'database' => app::env("DB_DATABASE"),
			'username' => app::env("DB_USERNAME"),
			'password' => app::env("DB_PASSWORD")
		];

		return $this->connect($args, "utf8");
	}

	public function connect($args, $charset) {
		$db = new \Sparrow();
		$db->setDb($args);

		$link = $db->getDb();
		$link->set_charset($charset);
	}

}
