<?php
    $parent = new WP_Query([
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_parent'    => $post->ID,
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
    ]);
?>

<article class="post post--stretch">
    <h1 class="post__heading text text--heading"><?php the_title(); ?></h1>

    <div class="post__archive archive">
        <?php if( $parent->have_posts() ) : ?>
        <div class="archive__list">

            <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
            <a class="archive__item" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link">

                <div class="archive__item-logo">
                    <img class="archive__item-image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/link.png" alt="Получение услуг в МФЦ">
                </div>

                <div class="archive__item-detail">
                    <h3 class="archive__item-tagline"><?php echo the_title(); ?></h3>

                    <?php if( has_excerpt() ) : ?>
                        <p class="archive__item-text"><?php the_excerpt(); ?></p>
                    <?php endif; ?>
                </div>

            </a>
            <?php endwhile; ?>

        </div>
        <?php endif; wp_reset_postdata(); ?>

    </div>

    <div class="post__item ugc">
        <?php the_content(); ?>
    </div>
</article>
