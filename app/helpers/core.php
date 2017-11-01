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
		app::set('app.base', $base);

		// Map required helpers methods
		app::map('conf', [$this, 'conf']);
		app::map('load', [$this, 'load']);
	}

 	public function run() {
		// Set start options
		app::conf();

		// Load registered classes
		app::load();

		// Set rewrite rules
		app::rewrite();

		// Start application
		app::start();
	}

	public function conf() {
        $base = app::get('app.base');

		app::set('app.controllers', ['admin', 'front']);
		app::set('flight.views.path', $base . "/templates/");
	}

	public function load() {
        // Map global methods
		app::map('env', [$this, 'env']);
 		app::map('inc', [$this, 'inc']);

		// Register required classes with Flight
		app::register('db', 'app\helpers\database');
		app::register('rewrite', 'app\helpers\rewrite');
	}

	/**
	 * Global env function for loading settings from .env file
	 *
	 * @since 1.0
	 */
	public function env($name, $default = '') {
		return getenv($name) ? getenv($name) : $default;
	}


	/**
	 * Function for modules include
	 *
	 * @since 1.0
	 */
	public function inc($module, $options = []) {
		$model = 'app\\models\\' . $module;

		(new $model($options))->render();
	}

}
