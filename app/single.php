<?php
/**
 * Template for display single post
 *
 * @package e-ul
 * @since 1.0
 * @version 1.2
 */

get_header(); ?>

<section class="content">
	<?php
		while (have_posts()) : the_post();

			// Include specific content template
			get_template_part( 'template-parts/content', 'post' );

			// Include sidebar
			get_sidebar();

		endwhile;
	?>
</section>

<?php get_footer();
