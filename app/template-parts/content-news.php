<?php
/**
 * Single news item template part
 *
 * @package e-ul
 * @since 1.2
 */
?>

<article class="archive-item">
	<?php
		printf(
			'<time class="archive-item-date" datetime="%s">%s</time>',
			get_the_time('c'),
			get_the_time('d F Y')
		);
	?>

	<a class="archive-item-link" href="<?php the_permalink(); ?>">
		<?php
			printf(
				'<h3 class="archive-item-title">%s</h3>',
				get_the_title()
			);

			printf(
				'<div class="archive-item-excerpt">%s</div>',
				get_the_excerpt()
			);
		?>
	</a>
</article>