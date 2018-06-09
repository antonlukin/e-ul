<article class="post">
	<h1 class="post__heading text text--heading"><?php the_title(); ?></h1>

	<div class="post__meta">
		<time class="post__meta-date" datetime="<?php the_time('c'); ?>"><?php the_time('d F Y'); ?></time>
	</div>

	<div class="post__item ugc">
		<?php the_content(); ?>
	</div>
</article>
