<?php
/**
 * Links template part
 *
 * @package e-ul
 * @since 1.2
 */

$links = new WP_Query( array( 'post_type' => 'links' ) ); ?>

<?php if ( $links->have_posts() ) : ?>
	<aside class="links">
		<h2 class="links-title"><?php _e( 'Электронные услуги и сервисы', 'e-ul' ); ?></h2>

		<div class="links-list">
			<?php while ( $links->have_posts() ) : $links->the_post(); ?>
				<a class="links-item" href="<?php the_permalink(); ?>" target="_blank" rel="noopener">
					<div class="links-item-logo">
						<?php
							if ( has_post_thumbnail() ) {
								printf(
									'<img class="links-item-image" src="%1$s" alt="%2$s">',
									esc_url( get_the_post_thumbnail_url( null, 'slider' ) ),
									esc_html( get_the_title() )
								);
							}
						?>
					</div>

					<div class="links-item-detail">
						<?php
							printf(
								'<h3 class="links-item-tagline">%s</h3>',
								esc_html( get_the_title() )
							);

							printf(
								'<div class="links-item-text">%s</div>',
								esc_html( get_the_excerpt() )
							);

							printf(
								'<span class="links-item-link">%s</span>',
								esc_url( get_the_permalink() )
							);
						?>
					</div>
				</a>
			<?php endwhile; ?>
		</div>

		<?php wp_reset_postdata(); ?>
	</aside>
<?php endif; ?>