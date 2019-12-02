<?php
/**
 * Custom template tags for this theme.
 *
 * @since 1.2.0
 */

if ( ! function_exists( 'eul_breadcrumbs' ) ) {

    function eul_breadcrumbs() {
        $pages = get_ancestors( get_the_ID(), 'page' );

        // Add home page to breadcrumbs
        $pages[] = get_option( 'page_on_front' );

        foreach ( array_reverse( $pages ) as $page ) {
            printf(
                '<a class="breadcrumbs__item" href="%s">%s</a>',
                get_permalink($page),
                get_the_title($page)
            );
        }

        printf(
            '<span class="breadcrumbs__item">%s</span>',
            get_the_title()
        );
    }

}
