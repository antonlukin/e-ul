<?php
/**
 * Search results template
 *
 * @package e-ul
 * @since 1.0
 * @version 1.2
 */

get_header(); ?>

<section class="archive">
	<?php if ( have_posts() ) : ?>
		<h2 class="archive-title"><?php _e( 'Результаты поиска: ', 'e-ul' ); ?></h2>

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
	<?php else: ?>
		<h2 class="archive-title"><?php _e( 'Ничего не найдено', 'e-ul' ); ?></h2>

		<div class="archive-message">
			<p><?php _e( 'К сожалению, ничего не удалось найти по запросу.', 'e-ul' ); ?></p>
			<p><?php _e( 'Попробуйте изменить ключевые слова и повторить.', 'e-ul' ); ?></p>
		</div>
	<?php endif; ?>
</section>

<?php get_footer();