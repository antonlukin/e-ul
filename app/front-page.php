<?php
/**
 * Template for showing site front-page
 *
 * Difference between front-page and home.php in a link below
 *
 * @link https://wordpress.stackexchange.com/a/110987
 *
 * @package e-ul
 * @since 1.0
 */

get_header(); ?>

<?php
	get_template_part('template-parts/aside', 'slider');
	get_template_part('template-parts/aside', 'news');
	get_template_part('template-parts/aside', 'links');
 	get_template_part('template-parts/aside', 'promo');
?>

<?php get_footer();