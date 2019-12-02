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
 * @version 1.2
 */

get_header(); ?>

<?php
	// Show slider post type
	get_template_part( 'template-parts/aside', 'slider' );

	// Recent news 4 entries
	get_template_part( 'template-parts/aside', 'news' );

	// Show links post type
	get_template_part( 'template-parts/aside', 'links' );

	if ( is_active_sidebar( 'eul-frontpage' ) ) :
		dynamic_sidebar( 'eul-frontpage' );
	endif;
?>

<?php get_footer();