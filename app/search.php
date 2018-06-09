<?php
/**
 * Search results template
 *
 * @package e-ul
 * @since 1.0
 */

get_header(); ?>


<section class="news block">
	<div class="news__wrap">

<?php if(have_posts()) : ?>

		<h2 class="news__heading text text--heading"><?php printf(__( 'Результаты поиска по запросу: %s', 'e-ul' ), get_search_query()); ?></h2>

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

<?php else: ?>
	<h2 class="news__heading text text--heading"><?php _e( 'По вашему запросу ничего не найдено', 'e-ul' ); ?></h2>
<?php
				get_search_form();
?>

<?php endif; ?>

	</div>
</section>



<?php

get_footer();
