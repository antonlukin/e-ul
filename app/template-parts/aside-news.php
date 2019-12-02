<?php
/**
 * News list template part
 *
 * @package e-ul
 * @since 1.2
 */

$news = new WP_Query( array( 'posts_per_page' => 4 ) ); ?>

<?php if ( $news->have_posts() ) : ?>
	<aside class="archive">
		<h2 class="archive-title"><?php _e( 'Новости ИТ региона', 'e-ul' ); ?></h2>

		<div class="archive-list">
			<?php
				while ( $news->have_posts() ) : $news->the_post();

					get_template_part('template-parts/content', 'news');

				endwhile;
			?>
		</div>

		<?php wp_reset_postdata(); ?>

		<?php
			printf(
				'<a class="archive-button button" href="%s">%s</a>',
				esc_url( home_url( '/news/' ) ),
				__( 'Читать все новости', 'e-ul' )
			);
		?>
	</aside>
<?php endif; ?>