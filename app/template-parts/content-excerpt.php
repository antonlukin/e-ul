<article class="news__item">
	<time class="news__item-date" datetime="<?php the_time('c'); ?>"><?php the_time('d F Y'); ?></time>

	<a class="news__item-link" href="<?php the_permalink(); ?>" role="link">
		<h3 class="news__item-title"><?php the_title(); ?></h3>
		<p class="news__item-excerpt">
			<?php echo get_the_excerpt(); ?>
			<span class="news__item-more icon icon--right"></span>
		</p>
	</a>
</article>
