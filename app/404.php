<?php
/**
 * Not found page
 *
 * @package e-ul
 * @since 1.0
 * @version 1.2
 */

get_header(); ?>

<section class="archive">
    <h2 class="archive-title"><?php _e( 'Страница не найдена', 'e-ul' ); ?></h2>

    <div class="archive-message">
        <p><?php _e( 'Возможно вы ошиблись при вводе адреса или страница была удалена.', 'e-ul' ); ?></p>
        <p><?php _e( 'Попробуйте перейти по ссылкам в меню или вернитсь на главную страницу.', 'e-ul' ); ?></p>
    </div>
</section>

<?php get_footer();