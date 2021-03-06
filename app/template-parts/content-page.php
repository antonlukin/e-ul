<?php
/**
 * Page template part
 *
 * @package e-ul
 * @since 1.2
 */
?>

<article class="post">
    <h1 class="post-title"><?php the_title(); ?></h1>

    <?php
        // Show pages children navigation
		get_template_part( 'template-parts/nav', 'pages' );
	?>

    <div class="post-content styles">
        <?php the_content(); ?>
    </div>
</article>
