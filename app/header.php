<?php
/**
 * The template for displaying the header
 *
 * @package e-ul
 * @since 1.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="theme-color" content="#262626">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="header">
    <div class="header__topline topline block">
        <button class="topline__button topline__button--search" role="button">
            <span class="icon icon--search"></span>
        </button>

        <div class="topline__logo">
            <a class="topline__logo-link logo" href="<?php echo esc_url(home_url('/')); ?>" role="banner">
                <span class="logo__image logo__image--ulgov">Правительство Ульяновской области</span>
                <span class="logo__image logo__image--eul">Корпорация развития ИТ</span>
                <span class="logo__title">Правительство<br> для граждан</span>
            </a>
        </div>

        <div class="topline__search">
            <?php get_search_form(); ?>
        </div>

        <button class="topline__button topline__button--menu toggle" role="button">
            <span class="toggle__line"></span>
            <span class="toggle__line"></span>
            <span class="toggle__line"></span>
        </button>
    </div>

    <div class="header__menu menu">
        <nav class="menu__list block" role="navigation">
        <?php
            // TODO: Hacky way. We have to fix it later

            $main_menu = wp_nav_menu([
                'theme_location' => 'main_menu',
                'depth' => 1,
                'echo' => false,
                'items_wrap' => '%3$s',
                'container' => false
            ]);

            echo strip_tags($main_menu, '<a>');
        ?>
        </nav>
    </div>
</header>
