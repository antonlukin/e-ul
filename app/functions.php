<?php
/**
 * Important functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @package e-ul
 * @since 1.1
 */


// Insert required js files
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('eul-scripts', get_bloginfo('template_url') . '/assets/scripts.min.js', [], '0.1', true);
});


// Insert styles
add_action('wp_print_styles', function() {
       wp_enqueue_style('eul-styles', get_bloginfo('template_url') . '/assets/styles.min.css', [], '0.3');
});


// Insert fonts
add_action('wp_enqueue_scripts', function() {
    $query_args = array(
        'family' => 'Roboto:300,400,700',
        'subset' => 'latin,cyrillic',
    );

    wp_enqueue_style('roboto', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), [], null);

    $query_args = array(
        'family' => 'Roboto+Condensed:300,400,700',
        'subset' => 'latin,cyrillic',
    );

    wp_enqueue_style('roboto-condensed', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), [], null);

});


// Change excerpt
add_filter('excerpt_more', function($more) {
    return '';
});

add_filter('excerpt_length', function($length) {
    return 20;
});


// Remove useless widgets from wp-admin section
add_action('admin_init', function() {
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
});


// Custom abilities theme support
add_action('after_setup_theme', function(){
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_post_type_support('page', 'excerpt');
});


// Add theme menus
add_action('init', function() {
    register_nav_menus([
        'main_menu' => 'Верхнее меню',
        'footer_menu' => 'Нижнее меню'
    ]);
});


// Remove fcking emojis and wordpress meta for security reasons
add_action('init', function() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link' );
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0 );
    remove_action('wp_head', 'rest_output_link_wp_head', 10 );
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10 );
});


// Admin bar
add_action('init', function() {
//    add_filter('show_admin_bar', '__return_false');

    add_action('admin_bar_menu', function($wp_admin_bar) {
        $wp_admin_bar->remove_menu('customize');
    }, 999);
});


// Disable embeds
add_action('wp_enqueue_scripts', function() {
    wp_deregister_script('wp-embed');
});


// Disable jquery
add_action('wp_enqueue_scripts', function() {
    if(!is_admin()) {
        wp_deregister_script('jquery');
    }
});


// Rewrite urls after switch theme just in case
add_action('after_switch_theme', function() {
     flush_rewrite_rules();
});


// We don't want to use default gallery styles anymore
add_filter('use_default_gallery_style', '__return_false');


// Add class to menu item link TODO: rework
add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
    if($args->theme_location === 'main_menu') {
        if($item->current === true)
            $atts['class'] = 'menu__link menu__link--current';
        else
            $atts['class'] = 'menu__link';
    }

     if($args->theme_location === 'footer_menu')
         $atts['class'] = 'footer__menu-link';

    return $atts;
}, 10, 3);


// Remove menu ids
add_filter('nav_menu_item_id', '__return_empty_string');


// Register widget area.
add_action('widgets_init', function(){
    register_sidebar([
        'name'          => __( 'Сайдбар', 'e-ul' ),
        'id'            => 'eul-sidebar',
        'description'   => __( 'Виджеты появятся в сайдбаре', 'e-ul' ),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => null,
        'after_title'   => null,
    ]);
});


// Hide title on custom html widgets
add_filter('widget_title', '__return_empty_string');


// Remove default widgets to prevent printing unready styles on production
add_action('widgets_init', function() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}, 11);


// Change standart body classes to own
add_filter('body_class', function($classes) {
    $classes = [];

    if(is_singular() && !is_front_page())
        $classes[] = 'framed';

    return $classes;
});


// Search only in posts
add_filter('pre_get_posts', function($query) {
    if(is_admin())
        return $query;

    if($query->is_search())
        $query->set('post_type', 'post');

    return $query;
});

// Disable post attachment pages
// Redirect to post parent if exists
add_action('template_redirect', function() {
    global $post;

    if(!is_attachment())
        return false;

    if(isset($post->post_parent) && $post->post_parent > 0)
        $url = get_permalink($post->post_parent);
    else
        $url = home_url('/');

    wp_redirect(esc_url($url), 301);
    exit;
});


function the_breadcrumbs($sep = '<i class="icon icon--right"></i>') {
    if (!is_front_page() && is_page()) {
        echo '<div class="breadcrumbs"><nav class="breadcrumbs__list block" role="navigation">';

        printf(
            '<a class="breadcrumbs__item breadcrumbs__item--link" href="%1$s">%2$s</a>%3$s',
            get_option('home'),
            __('Главная страница', 'e-ul'),
            $sep
        );

        $ancestors = array_reverse(get_ancestors(get_the_ID(), 'page'));
        if( $ancestors) {
            foreach( $ancestors as $item ) {
                $post = get_post( $item );

                printf(
                    '<a class="breadcrumbs__item breadcrumbs__item--link" href="%1$s">%2$s</a>%3$s',
                    get_the_permalink($post->ID),
                    $post->post_title,
                    $sep
                );
            }
        }

        printf('<span class="breadcrumbs__item breadcrumbs__item--text">%1$s</span>',
            get_the_title()
        );

        echo '</nav></div>';
    }
}

