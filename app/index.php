<?php
/**
 * Index archive template
 *
 * @package e-ul
 * @since 1.0
 * @version 1.2
 */

get_header(); ?>

<section class="archive">
	<?php if ( have_posts() ) : ?>
		<h2 class="archive-title"><?php _e( 'Новости ИТ региона', 'e-ul' ); ?></h2>

		<div class="archive-list">
			<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'news' );

				endwhile;
			?>
		</div>

		<?php
			the_posts_pagination(
				array(
					'prev_next' => false,
					'mid_size' => 2
				)
			);
		?>
	<?php endif; ?>
</section>

<?php get_footer();
