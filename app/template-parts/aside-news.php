<?php
/**
 * News list template part
 *
 * @package e-ul
 * @since 1.2
 */

$news = new WP_Query( array( 'posts_per_page' => 4 ) ); ?>

<?php if ( $news->have_posts() ) : ?>
	<section class="news">
		<h2 class="news-title"><?php _e( 'Новости ИТ региона', 'e-ul' ); ?></h2>

		<div class="news-list">
			<?php while($news->have_posts()) : $news->the_post(); ?>
				<article class="news-item">
					<?php
						printf(
							'<time class="news-item-date" datetime="%s">%s</time>',
							get_the_time('c'),
							get_the_time('d F Y')
						);
					?>

					<a class="news-item-link" href="<?php the_permalink(); ?>">
						<?php
							printf(
								'<h3 class="news-item-title">%s</h3>',
								get_the_title()
							);

							printf(
								'<div class="news-item-excerpt">%s</div>',
								get_the_excerpt()
							);
						?>
					</a>
				</article>
				<?php endwhile; ?>
		</div>

		<?php wp_reset_postdata(); ?>

		<?php
			printf(
				'<a class="news-button button" href="%s">%s</a>',
				esc_url( home_url( '/news/' ) ),
				__( 'Читать все новости', 'e-ul' )
			);
		?>
	</section>
<?php endif; ?>