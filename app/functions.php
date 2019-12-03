<?php
/**
 * Important functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @package e-ul
 * @since 1.0
 * @version 1.2
 */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function eul_theme_support() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Set content-width.
    global $content_width;

    if ( ! isset( $content_width ) ) {
        $content_width = 700;
    }

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Set post thumbnail size.
    set_post_thumbnail_size( 700, 9999 );

    // Support default title tag
    add_theme_support( 'title-tag' );

    // Support html5
    add_theme_support( 'html5', array( 'gallery' ) );

    // Add excerpt field to pages
    add_post_type_support( 'page', 'excerpt' );
}

add_action( 'after_setup_theme', 'eul_theme_support' );


/**
 * Include template tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Include slider post type register
 */
require get_template_directory() . '/classes/class-eul-slider.php';

/**
 * Include links post type register
 */
require get_template_directory() . '/classes/class-eul-links.php';

/**
 * Include external url handler
 */
require get_template_directory() . '/classes/class-eul-external.php';

/**
 * Include login screen styles handler
 */
require get_template_directory() . '/classes/class-eul-loginscreen.php';

/**
 * Include feedback widget class
 */
require get_template_directory() . '/widgets/feedback.php';


/**
 * Insert required js files
 */
function eul_theme_scripts() {
    $version = wp_get_theme()->get( 'Version' );

    if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
        $version = date( 'U' );
    }

    wp_enqueue_script( 'eul-theme', get_template_directory_uri() . '/assets/scripts.min.js', array(), $version, true );
}

add_action( 'wp_enqueue_scripts', 'eul_theme_scripts' );


/**
 * Insert theme styles
 */
function eul_theme_styles() {
    $version = wp_get_theme()->get( 'Version' );

    if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
        $version = date( 'U' );
    }

    wp_enqueue_style( 'eul-theme', get_template_directory_uri() . '/assets/styles.min.css', array(), $version );
}

add_action( 'wp_print_styles', 'eul_theme_styles' );


/**
 * We don't use gutenberg for now so it would be better to remove useless styles
 */
function eul_gutenberg_styles() {
    wp_dequeue_style( 'wp-block-library' );
}

add_action( 'wp_print_styles', 'eul_gutenberg_styles', 11 );


/**
 * Update excerpt more
 */
function eul_excerpt_more() {
    return '…';
}

add_filter( 'excerpt_more', 'eul_excerpt_more' );


/**
 * Set maximum excerpt length
 */
function eul_excerpt_length() {
    return 200;
}


/**
 * Update excerpt
 */
function eul_update_excerpt( $excerpt ) {
    preg_match_all( '~(.+?(?:\.|\!|\?)\s)~is', $excerpt, $sentences );

    if ( ! empty( $sentences[0] ) ) {
        $excerpt = '';

        foreach ( $sentences[0] as $sentence ) {
            $excerpt = $excerpt . $sentence;

            if ( mb_strlen( $excerpt ) > 150 ) {
                break;
            }
        }
    }

    return $excerpt;
}

add_filter( 'get_the_excerpt', 'eul_update_excerpt' );


/**
 * Remove useless widgets from wp-admin section
 */
function eul_update_dashboard() {
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
}

add_action( 'admin_init', 'eul_update_dashboard' );


/**
 * Add theme menu
 */
function eul_menus() {
    $locations = array(
        'main_menu' => __( 'Верхнее меню', 'e-ul' ),
        'footer_menu' => __( 'Нижнее меню', 'e-ul' ),
        'social_menu' => __( 'Меню соцсетей', 'e-ul' )
    );

    register_nav_menus( $locations );
}

add_action( 'init', 'eul_menus' );


/**
 * Remove emojis and wordpress meta for security reasons
 */
function eul_remove_emoji() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

add_action( 'init', 'eul_remove_emoji' );


/**
 * Remove WordPress meta for security reasons
 */
function eul_remove_meta() {
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link' );
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
}

add_action( 'init', 'eul_remove_meta' );


/**
 * Disable embeds
 */
function eul_disable_embeds() {
    wp_deregister_script( 'wp-embed' );
}

add_action( 'wp_enqueue_scripts', 'eul_disable_embeds' );


/**
 * Disable jquery
 */
function eul_disable_jquery() {
    if ( ! is_admin() ) {
        wp_deregister_script( 'jquery' );
    }
}

add_action( 'wp_enqueue_scripts', 'eul_disable_jquery' );


/**
 * Remove menu ids
 */
add_filter( 'nav_menu_item_id', '__return_empty_string' );


/**
 * Add class to menu item link
 */
function eul_menu_attributes( $atts, $item, $args ) {
    if ( $args->theme_location === 'main_menu' ) {
        $atts['class'] = 'header-menu-link';

        if ( $item->current === true ) {
            $atts['class'] = $atts['class'] . ' header-menu-link-current';
        }
    }

    if ( $args->theme_location === 'footer_menu' ) {
        $atts['class'] = 'footer-menu-link';
    }

    if ( $args->theme_location === 'social_menu' ) {
        $atts['class'] = 'social-menu-link';
    }

    return $atts;
}

add_filter( 'nav_menu_link_attributes', 'eul_menu_attributes', 10, 3 );


/**
 * Add class to menu item tag
 */
function eul_menu_class( $classes, $item, $args ) {
    if ( $args->theme_location === 'main_menu' ) {
        $classes = array( 'header-menu-item' );
    }

    if ( $args->theme_location === 'social_menu' ) {
        $classes = array( 'social-menu-item' );
    }

    if ( $args->theme_location === 'footer_menu' ) {
        $classes = array( 'footer-menu-item' );
    }

    // Add pre-defined menu classes
    $item_classes = (array) get_post_meta( $item->ID, '_menu_item_classes', true );

    foreach ( $item_classes  as $item_class ) {
        if ( ! empty( $item_class ) ) {
            $classes[] = $item_class;
        }
    }

    return $classes;
}

add_filter( 'nav_menu_css_class', 'eul_menu_class', 10, 3 );


/**
 * Register widget area.
 */
function eul_init_widgets() {
    // Sidebar
    register_sidebar( array(
        'id' => 'eul-sidebar',
        'name' => __( 'Сайдбар', 'e-ul' ),
        'description' => __( 'Виджеты появятся в сайдбаре', 'e-ul' ),
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ) );

    // Frontpage bottom
    register_sidebar( array(
        'id' => 'eul-frontpage',
        'name' => __( 'На главной странице', 'e-ul' ),
        'description' => __( 'Виджеты появятся снизу на главной странице', 'e-ul' ),
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => null,
        'after_title' => null,
    ) );
}

add_action( 'widgets_init', 'eul_init_widgets' );


/**
 * Remove default widgets to prevent printing unready styles on production
 */
function eul_remove_widgets() {
    unregister_widget( 'WP_Widget_Pages' );
    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Archives' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Categories' );
    unregister_widget( 'WP_Widget_Recent_Posts' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
    unregister_widget( 'WP_Widget_RSS' );
    unregister_widget( 'WP_Widget_Tag_Cloud' );
    unregister_widget( 'WP_Nav_Menu_Widget' );
    unregister_widget( 'WP_Widget_Media_Audio' );
    unregister_widget( 'WP_Widget_Media_Video' );
    unregister_widget( 'WP_Widget_Media_Gallery' );

}

add_action( 'widgets_init', 'eul_remove_widgets', 11 );


/**
 * Remove admin bar styles from header
 */
function eul_adminbar_styles() {
    remove_action( 'wp_head', '_admin_bar_bump_cb' );
}

add_action( 'get_header', 'eul_adminbar_styles' );


/**
 * Remove comments from menu
 */
function eul_comments_menu() {
    remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'eul_comments_menu' );

/**
 * Removes comments from post and pages
 */
function eul_remove_comments() {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ( $pagenow === 'edit-comments.php' ) {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

    // Disable support for comments and trackbacks in post types
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
}

add_action( 'admin_init', 'eul_remove_comments' );


/**
 * Removes comments from admin bar
 */
function eul_comments_bar() {
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu( 'comments' );
}

add_action( 'wp_before_admin_bar_render', 'eul_comments_bar' );


/**
 * Change standart body classes to custom
 */
function eul_body_class( $classes ) {
    $classes = array();

    if ( is_single() ) {
        $classes[] = 'is-single';
    }

    if ( is_archive() ) {
        $classes[] = 'is-archive';
    }

    if ( is_admin_bar_showing() ) {
        $classes[] = 'is-adminbar';
    }

    if ( is_front_page() ) {
        $classes[] = 'is-front';
    }

    if ( is_singular( 'page' ) && ! is_front_page() ) {
        $classes[] = 'is-page';
    }

    if ( is_singular( 'post' ) ) {
        $classes[] = 'is-post';
    }

    return $classes;
}

add_filter( 'body_class', 'eul_body_class' );


/**
 * Search only in posts
 */
function eul_update_search( $query ) {
    if ( ! is_admin() ) {
        if ( $query->is_search() ) {
            $query->set( 'post_type', 'post' );
        }
    }
}

add_filter( 'pre_get_posts', 'eul_update_search' );


/**
 * Disable post attachment pages
 * Redirect to post parent if exists
 */
function eul_redirect_attachments() {
    global $post;

    if ( is_attachment() ) {
        $url = home_url( '/' );

        // Try to find parent url
        if ( isset( $post->post_parent ) && $post->post_parent > 0 ) {
            $url = get_permalink( $post->post_parent );
        }

        wp_redirect( esc_url( $url ), 301);
        exit;
    }
}

add_action( 'template_redirect', 'eul_redirect_attachments' );