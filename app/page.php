<?php
/**
 * Template for display page
 *
 * @package e-ul
 * @since 1.0
 */

get_header(); ?>



<section class="content block">
	<?php
		if ( have_posts() ) :

			while (have_posts()) : the_post();

				// Include specific content template
				get_template_part('template-parts/content', 'page');

			endwhile;

		else:

			// Include "no posts found" template
			get_template_part('template-parts/content', 'none');

		endif;
	?>
</section>


<?php

get_footer();
