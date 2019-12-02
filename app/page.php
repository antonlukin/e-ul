<?php
/**
 * Template for display page
 *
 * @package e-ul
 * @since 1.0
 * @version 1.2
 */

get_header(); ?>

<div class="breadcrumbs">
	<nav class="breadcrumbs__list" role="navigation">
		<?php eul_breadcrumbs(); ?>
	</nav>
</div>

<section class="content">
	<?php
		while (have_posts()) : the_post();

			// Include specific content template
			get_template_part( 'template-parts/content', 'page' );

		endwhile;
	?>
</section>

<?php get_footer();