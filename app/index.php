<?php
/**
 * The main template file
 *
 * @package e-ul
 * @since 1.0
 */

get_header(); ?>

<?php if(have_posts()) : ?>

<section class="news block">
	<div class="news__wrap">
		<h2 class="news__heading text text--heading"><?php the_archive_title(); ?></h2>

		<div class="news__list">

<?php

	while(have_posts()) : the_post();

		get_template_part('template-parts/content', 'excerpt');

	endwhile;

?>

		</div>

<?php
		the_posts_pagination([
				'prev_text' => '<span class="icon icon--left">',
				'next_text' => '<span class="icon icon--right">',
				'mid_size' => 4
		]);
?>

	</div>
</section>

<?php endif; ?>

<?php

get_footer();
