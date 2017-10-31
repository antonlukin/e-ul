<?php
/**
 * E-ul: Ulyanovsk multifunctional center promo website
 *
 * @copyright   Copyright (c) 2017, Anton Lukin <anton@lukin.me>
 * @license     MIT, https://github.com/antonlukin/e-ul/LICENSE
 */


/**
 * Init app settings with .env
 *
 * @link https://github.com/vlucas/phpdotenv
 * @since 1.0
 */
(new Dotenv\Dotenv(__DIR__ . '/../'))->load();


/**
 * Loading init helpers module
 *
 * @since 1.0
 */
(new app\helpers\core(__DIR__))->run();

