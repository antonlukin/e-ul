<?php
/**
 * External url handler for pages
 *
 * @package e-ul
 * @since 1.2
 */

if ( ! class_exists( 'Eul_External' ) ) {
    /**
     * Register slider post type
     */
    class Eul_External {
        /**
         * Post slider meta
         */
        private static $post_meta = '_eul-external-meta';


        /**
         * Static method instead of construct
         */
        public static function register() {
            // Show custom input in page attributes metabox
            add_action( 'page_attributes_misc_attributes', array( __CLASS__, 'display_attributes' ) );

            // Save metabox
            add_action( 'save_post', array( __CLASS__, 'save_metabox' ) );

            // Update page link
            add_filter( 'page_link', array( __CLASS__, 'replace_external_url' ), 10, 2 );

            // Update page list with custom link
            add_filter( 'display_post_states', array( __CLASS__, 'update_page_list' ), 10, 2 );
        }


        /**
         * Update page list with custom link
         */
        public static function update_page_list( $states, $post ) {
            $post_id = get_the_ID();

            if ( get_post_type( $post_id ) === 'page' ) {
                $meta = get_post_meta( $post_id, self::$post_meta, true );

                if ( $meta ) {
                    $states['plt'] = sprintf( '<span class="dashicons dashicons-admin-links"></span> <span>%s</span>', esc_url( $meta ) );
                }
            }

            return $states;
        }


        /**
         * Show custom input in page attributes metabox
         */
        public static function display_attributes() {
            $post_id = get_the_ID();

            if ( get_post_type( $post_id ) === 'page' ) {
                $meta = get_post_meta( $post_id, self::$post_meta, true );

                printf(
                    '<p class="post-attributes-label-wrapper"><label class="post-attributes-label">%s</label></p>',
                    __( 'Ссылка на внешнюю страницу', 'e-ul' )
                );

                printf(
                    '<input class="widefat" type="text" name="%s" value="%s">',
                    esc_attr( self::$post_meta ),
                    esc_url( $meta )
                );
            }
        }


        /**
         * Replace external url
         */
        public static function replace_external_url( $page_link, $post_id ) {
            $meta = get_post_meta( $post_id, self::$post_meta, true );

            if ( $meta ) {
                $page_link = esc_url( $meta );
            }

            return $page_link;
        }


        /**
         * Save metabox options
         */
        public static function save_metabox( $post_id ) {
            if ( get_post_type( $post_id ) !== 'page' ) {
                return;
            }

            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }

            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }

            if ( isset ( $_REQUEST[ self::$post_meta ] ) ) {
                $meta = sanitize_text_field( $_REQUEST[ self::$post_meta ] );

                // Update post meta
                update_post_meta( $post_id, self::$post_meta, $meta );
            }
        }


        /**
         * Enqueue assets to admin post screen only
         */
        public static function add_admin_assets( $hook ) {
            $post_id = get_the_ID();

            if ( get_post_type( $post_id ) === self::$post_type ) {
                $version = wp_get_theme()->get( 'Version' );
                $include = get_template_directory_uri() . '/assets/admin';

                // Insert wp media scripts
                wp_enqueue_media();

                // Insert admin styles
                wp_enqueue_style( 'eul-slider-metabox', $include . '/slider-metabox.css', array(), $version );

                // Insert admin scripts
                wp_enqueue_script( 'eul-slider-metabox', $include . '/slider-metabox.js', array( 'jquery' ), $version );

                $options = [
                    'post_id' => absint( $post_id ),
                    'choose' => __( 'Выберите изображение слайдера', 'e-ul' )
                ];

                wp_localize_script( 'eul-slider-metabox', 'eul_slider_metabox', $options );
            }
        }
    }


    /**
     * Start class
     */
    add_action( 'init', array( 'Eul_External', 'register' ) );
}