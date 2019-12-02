<?php
/**
 * Add links post type.
 *
 * @package e-ul
 * @since 1.2
 */

if ( ! class_exists( 'Eul_Links' ) ) {
    /**
     * Register links post type
     */
    class Eul_Links {
        /**
         * Post type slug
         */
        public static $post_type = 'links';


        /**
         * Post links meta
         */
        public static $post_meta = '_eul-links-meta';


        /**
         * Static method instead of construct
         */
        public static function register() {
            $labels = array(
                'name' => __( 'Ссылки', 'e-ul' ),
                'menu_name' => __( 'Ссылки', 'e-ul' ),
                'all_items' => __( 'Все ссылки', 'e-ul' ),
                'singular_name' => __( 'Ссылка в сервисы', 'e-ul' ),
                'add_new' => __( 'Добавить ссылку', 'e-ul' ),
                'edit_item' => __( 'Редактировать ссылку', 'e-ul' )
            );

            $options = array(
                'labels' => $labels,
                'label' => __( 'Ссылки', 'e-ul' ),
                'supports' => array( 'title' ),
                'public' => true,
                'menu_position' => 25,
                'menu_icon' => 'dashicons-admin-links',
                'exclude_from_search' => true
            );

            register_post_type( self::$post_type, $options );

            // Add links settings metabox
            add_action( 'add_meta_boxes', array( __CLASS__, 'add_metabox' ) );

            // Save metabox
            add_action( 'save_post', array( __CLASS__, 'save_metabox' ) );

            // Add admin styles and scripts
            add_action( 'admin_enqueue_scripts', array( __CLASS__, 'add_admin_assets' ) );

            // Update links post link
            add_filter( 'post_type_link', array( __CLASS__, 'replace_links_link' ), 10, 2 );

            // Update links excerpt
            add_filter( 'get_the_excerpt', array( __CLASS__, 'create_excerpt' ), 12, 2 );
        }


        /**
         * Replace links link
         */
        public static function replace_links_link( $post_link, $post ) {
            $post_id = $post->ID;

            if ( get_post_type( $post_id ) === self::$post_type ) {
                $meta = get_post_meta($post_id, self::$post_meta, true);

                if ( ! empty( $meta['link'] ) ) {
                    $post_link = esc_url( $meta['link'] );
                }
            }

            return $post_link;
        }


        /**
         * Create links excerpt from meta
         */
        public static function create_excerpt( $post_excerpt, $post ) {
            $post_id = $post->ID;

            if ( get_post_type( $post_id ) === self::$post_type ) {
                $meta = get_post_meta($post_id, self::$post_meta, true);

                if ( ! empty( $meta['text'] ) ) {
                    $post_excerpt = esc_html( $meta['text'] );
                }
            }

            return $post_excerpt;
        }


        /**
         * Add links settings metabox
         */
        public static function add_metabox() {
            add_meta_box(
                'eul-links-metabox',
                __( 'Настройки ссылки', 'e-ul' ),
                array( __CLASS__, 'display_metabox' ),
                self::$post_type,
                'normal', 'high'
            );
        }


        /**
         * Display links settings metabox
         */
        public static function display_metabox() {
            $meta = get_post_meta( get_the_ID(), self::$post_meta, true );

            $args = array(
                'link' => '',
                'text' => '',
                'image' => ''
            );

            // Set default meta values
            $meta = wp_parse_args( $meta, $args );

            printf(
                '<p><label for="eul-links-link">%s</label><input id="eul-links-link" type="text" name="%s[link]" value="%s"></p>',
                __( 'Ссылка: ', 'e-ul' ),
                esc_attr( self::$post_meta ),
                esc_url( $meta['link'] )
            );

            printf(
                '<p><label for="eul-links-text">%s</label><textarea id="eul-links-text" name="%s[text]">%s</textarea></p>',
                __( 'Описание: ', 'e-ul' ),
                esc_attr( self::$post_meta ),
                esc_html( $meta['text'] )
            );

            printf(
                '<p><label for="eul-links-image">%s</label><input id="eul-links-image" type="text" name="%s[image]" value="%s"></p>',
                __( 'Ссылка на логотип: ', 'e-ul' ),
                esc_attr( self::$post_meta ),
                esc_url( $meta['image'] )
            );

            printf(
                '<small>%2$s – <a href="%1$s" target="_blank">%3$s</a></small>',
                esc_url( admin_url( '/media-new.php' ) ),
                __( 'Изображение размером 100×100', 'e-ul' ),
                __( 'Загрузить', 'e-ul' )
            );

            wp_nonce_field( 'save-metabox', 'eul-links-metabox' );
        }


         /**
          * Save metabox options
          */
        public static function save_metabox( $post_id ) {
            if ( get_post_type( $post_id ) !== self::$post_type ) {
                return;
            }

            if ( ! isset( $_REQUEST['eul-links-metabox'] ) ) {
                return;
            }

            if ( ! wp_verify_nonce( $_REQUEST['eul-links-metabox'], 'save-metabox' ) ) {
                return;
            }

            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }

            // Update post meta
            if ( isset ( $_REQUEST[ self::$post_meta ] ) ) {
                $meta = array_map( 'sanitize_text_field', $_REQUEST[ self::$post_meta ] );

                // Duplicate attachment as custom meta
                if ( ! empty( $meta['image'] ) ) {
                    $attachment = attachment_url_to_postid( $meta['image'] );

                    if ( $attachment > 0 ) {
                        update_post_meta( $post_id, '_thumbnail_id', $attachment );
                    } else {
                        delete_post_meta( $post_id, '_thumbnail_id' );

                        // Reset meta image
                        $meta['image'] = '';
                    }
                }

                // Update post meta with new values
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

                // Insert admin styles
                wp_enqueue_style( 'eul-links-metabox', $include . '/links-metabox.css', array(), $version );
            }
        }
    }


    /**
     * Start class
     */
    add_action( 'init', array( 'Eul_Links', 'register' ) );
}