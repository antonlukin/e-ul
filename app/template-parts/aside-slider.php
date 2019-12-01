<?php
/**
 * Slider template part
 *
 * @package e-ul
 * @since 1.2
 */

$slides = new WP_Query( array( 'post_type' => 'slider' ) ); ?>

<?php if ( $slides->have_posts() ) : ?>
	<aside class="swiper-container slider">

		<div class="swiper-wrapper">
			<?php while($slides->have_posts()) : $slides->the_post(); ?>
				<article class="swiper-slide slider-content">
					<?php
						if ( $image = get_the_post_thumbnail_url( null, 'slider' ) ) {
							printf(
								'<img class="slider-image" src="%1$s" alt="%2$s">',
								esc_url( $image ),
								esc_html( get_the_title() )
							);
						}
					?>

					<div class="slider-item">
						<?php
							printf(
								'<h2 class="slider-item-title">%s</h2>',
								esc_html( get_the_title() )
							);

							printf(
								'<div class="slider-item-text">%s</div>',
								esc_html( get_the_excerpt() )
							);

							printf(
								'<a class="slider-item-button button" href="%s" target="_blank">%s</a>',
								esc_url( get_the_permalink() ),
								__( 'Подробнее', 'e-ul' )
							);
						?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<?php wp_reset_postdata(); ?>

		<button class="slider-nav slider-nav-prev">←</button>
		<button class="slider-nav slider-nav-next">→</button>

	</aside>
<?php endif; ?>