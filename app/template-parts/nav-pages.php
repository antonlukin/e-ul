<?php
/**
 * Page childern template part
 *
 * @package e-ul
 * @since 1.2
 */

$pages = new WP_Query( array( 'post_type' => 'page', 'orderby' => 'menu_order', 'post_parent' => get_the_ID() ) ); ?>

<?php if ( $pages->have_posts() ) : ?>
    <div class="pages post-pages">
        <?php while ( $pages->have_posts() ) : $pages->the_post(); ?>
            <a class="pages-item" href="<?php the_permalink(); ?>">
                <h3 class="pages-item-tagline"><?php the_title(); ?></h3>

                <?php if ( has_excerpt() ): ?>
                    <div class="pages-item-text"><?php echo get_the_excerpt(); ?></div>
                <?php endif;?>
            </a>
        <?php endwhile;?>

        <?php wp_reset_postdata();?>
    </div>
<?php endif;?>