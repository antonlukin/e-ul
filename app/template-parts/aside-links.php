<?php
/**
 * Show all availilble bookmarks from link manager
 *
 * @package e-ul
 * @since 1.2
 */
?>

<?php
	$term = get_term_by( 'slug', 'services', 'link_category' );

	$args = array(
		'category' => $term->term_id
	);
?>

<?php if ( $links = get_bookmarks( $args ) ) : ?>

	<aside class="links">
		<h2 class="links-title"><?php _e( 'Электронные услуги и сервисы', 'e-ul' ); ?></h2>

		<div class="links-list">
			<?php foreach ( $links as $link ) : ?>
				<a class="links-item" href="<?php echo esc_url( $link->link_url ); ?>" target="<?php esc_html_e( $link->link_target ); ?>" rel="noopener">
					<div class="links-item-logo">
						<img class="links-item-image" src="<?php echo esc_url( $link->link_image ); ?>" alt="<?php esc_html_e( $link->link_name ); ?>">
					</div>

					<div class="links-item-detail">
						<h3 class="links-item-tagline"><?php esc_html_e( $link->link_name ); ?></h3>

						<p class="links-item-text"><?php esc_html_e( $link->link_description ); ?></p>
						<p class="links-item-link"><?php echo esc_url( $link->link_url ); ?></p>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</aside>

<?php endif; ?>