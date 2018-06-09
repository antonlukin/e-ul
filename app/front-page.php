<?php
/**
 * Template for showing site front-page
 *
 * Difference between front-page and home.php in a link below
 *
 * @link https://wordpress.stackexchange.com/a/110987
 *
 * @package e-ul
 * @since 1.0
 */

get_header(); ?>

<?php get_template_part('template-parts/aside', 'slider'); ?>

<?php
	$front_news = new WP_Query([
		'posts_per_page' => 4,
 		'ignore_sticky_posts' => 1,
 		'post_status' => 'publish'
	]);


	if($front_news->have_posts()) :
?>

<section class="news block">
	<div class="news__wrap">
		<h2 class="news__heading text text--heading"><?php _e('Новости ИТ региона', 'e-ul'); ?></h2>

		<div class="news__list">

<?php while($front_news->have_posts()) : $front_news->the_post(); ?>
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
<?php endwhile; wp_reset_postdata(); ?>

		</div>

		<div class="news__button">
			<a class="button" href="<?php echo esc_url(home_url('/news/')); ?>">Читать все новости</a>
		</div>
	</div>
</section>

<?php endif; ?>

<?php
	get_template_part('template-parts/aside', 'social');
	get_template_part('template-parts/aside', 'services');
 	get_template_part('template-parts/aside', 'promo');
?>

<?php

get_footer();
