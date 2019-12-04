<?php
/**
 * The template for displaying the header
 *
 * @package e-ul
 * @since 1.1
 * @version 1.2
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#262626">
    <meta name="description" content="<?php _e( 'Приближаем госуслуги к гражданам, развиваем информационные технологии в Ульяновской области', 'e-ul' ); ?>">

    <meta property="og:site_name" content="<?php _e( 'Корпорация Правительство для граждан', 'e-ul' ); ?>">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:description" content="<?php _e( 'Приближаем госуслуги к гражданам, развиваем информационные технологии в Ульяновской области', 'e-ul' ); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/poster.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="https://e-ul.ru/">
    <meta property="og:title" content="<?php _e( 'Корпорация Правительство для граждан', 'e-ul' ); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/poster.jpg">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="header">
    <div class="header-topline">
        <button class="header-topline-search" id="toggle-search"><?php _e( 'Поиск', 'e-ul' ); ?></button>

        <div class="header-topline-logo logo">
            <a class="logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <span class="logo-link-image logo-link-ulgov"></span>
                <span class="logo-link-image logo-link-eul"></span>

                <span class="logo-link-title"><?php _ex( 'Правительство<br> для граждан', 'header logo', 'e-ul' ); ?></span>
            </a>
        </div>

        <div class="header-topline-form">
            <?php get_search_form(); ?>
        </div>

        <button class="header-topline-menu toggle" id="toggle-menu">
            <span class="toggle-line"></span>
            <span class="toggle-line"></span>
            <span class="toggle-line"></span>
        </button>
    </div>

    <div class="header-menu">
        <ul class="header-menu-list" role="navigation">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'main_menu',
                    'depth' => 1,
                    'items_wrap' => '%3$s',
                    'container' => false
                ) );
            ?>
        </ul>
    </div>
</header>