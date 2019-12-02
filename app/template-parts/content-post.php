<?php
/**
 * Post template part
 *
 * @package e-ul
 * @since 1.2
 */
?>

<article class="post">
    <h1 class="post-title"><?php the_title(); ?></h1>

	<div class="post__meta">
		<time class="post__meta-date" datetime="<?php the_time('c'); ?>"><?php the_time('d F Y'); ?></time>
	</div>

    <div class="post-content styles">
        <?php the_content(); ?>
    </div>
</article>