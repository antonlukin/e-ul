<?php
/**
 * Feedback widget template part
 *
 * @package e-ul
 * @since 1.2
 */
?>

<div class="feedback">
	<?php
		printf(
			'<h2 class="feedback-title">%s</h2>',
			esc_html( $instance['title'] )
		);

		printf(
			'<div class="feedback-text">%s</div>',
			wp_kses_post( $instance['text'] )
		);

		printf(
			'<a class="feedback__button button" href="%s" role="button">%s</a>',
			esc_url( $instance['link'] ),
			esc_html( $instance['button'] )
		);
	?>
</div>