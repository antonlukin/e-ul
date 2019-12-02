<?php
/**
 * Add slider post type.
 *
 * @package e-ul
 * @since 1.2
 */

if ( ! class_exists( 'Eul_Slider' ) ) {
    /**
     * Register slider post type
     */
    class Eul_Slider {
        /**
         * Post type slug
         */
        public static $post_type = 'slider';


        /**
         * Post slider meta
         */
        public static $post_meta = '_eul-slider-meta';


        /**
         * Static method instead of construct
         */
        public static function register() {
            $labels = array(
                'name' => __( 'Слайдер', 'e-ul' ),
                'menu_name' => __( 'Слайдер', 'e-ul' ),
                'all_items' => __( 'Все слайды', 'e-ul' ),
                'singular_name' => __( 'Ссылка в слайдер', 'e-ul' ),
                'add_new' => __( 'Добавить слайд', 'e-ul' ),
                'edit_item' => __( 'Редактировать слайд', 'e-ul' )
            );

            $options = array(
                'labels' => $labels,
                'label' => __( 'Слайдер', 'e-ul' ),
                'supports' => array( 'title' ),
                'public' => true,
                'menu_position' => 20,
                'menu_icon' => 'dashicons-images-alt',
                'exclude_from_search' => true
            );

            register_post_type( self::$post_type, $options );

            // Add slider image size
            add_image_size( 'slider', 1920, 640, true );

            // Add slider settings metabox
            add_action( 'add_meta_boxes', array( __CLASS__, 'add_metabox' ) );

            // Save metabox
            add_action( 'save_post', array( __CLASS__, 'save_metabox' ) );

            // Add admin styles and scripts
            add_action( 'admin_enqueue_scripts', array( __CLASS__, 'add_admin_assets' ) );

            // Add swiper vendor assets
            add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_swiper_assets' ) );

            // Add slider image size to options
            add_filter( 'image_size_names_choose', array( __CLASS__, 'add_slider_size' ) );

            // Update slider post link
            add_filter( 'post_type_link', array( __CLASS__, 'replace_slider_link' ), 10, 2 );

            // Update slider excerpt
            add_filter( 'get_the_excerpt', array( __CLASS__, 'create_excerpt' ), 12, 2 );
        }


        /**
         * Insert swiper scripts and styles for front-page
         */
        public static function add_swiper_assets() {
            if ( is_front_page() ) {
                $version = '5.2.1';

                // Include styles
                wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/vendor/swiper.min.css', array(), $version );

                // Include scripts
                wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/vendor/swiper.min.js', array(), $version, true );
            }
        }


        /**
         * Add slider image size to names choose
         */
        public static function add_slider_size( $sizes ) {
            $slider = array(
                'slider' => __( 'Слайдер', 'e-ul' )
            );

            return array_merge( $sizes, $slider );
        }


        /**
         * Replace slider link
         */
        public static function replace_slider_link( $post_link, $post ) {
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
         * Create slider excerpt from meta
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
         * Add slider settings metabox
         */
        public static function add_metabox() {
            add_meta_box(
                'eul-slider-metabox',
                __( 'Настройки ссылки в слайдере', 'e-ul' ),
                array( __CLASS__, 'display_metabox' ),
                self::$post_type,
                'normal', 'high'
            );
        }


        /**
         * Display slider settings metabox
         */
        public static function display_metabox() {
            $meta = get_post_meta( get_the_ID(), self::$post_meta, true );

            $args = array(
                'link' => '',
                'text' => '',
                'attachment' => ''
            );

            // Set default meta values
            $meta = wp_parse_args( $meta, $args );

            printf(
                '<p><label for="eul-slider-link">%s</label><input id="eul-slider-link" type="text" name="%s[link]" value="%s"></p>',
                __( 'Ссылка: ', 'e-ul' ),
                esc_attr( self::$post_meta ),
                esc_url( $meta['link'] )
            );

            printf(
                '<p><label for="eul-slider-text">%s</label><textarea id="eul-slider-text" name="%s[text]">%s</textarea></p>',
                __( 'Описание: ', 'e-ul' ),
                esc_attr( self::$post_meta ),
                esc_html( $meta['text'] )
            );

            if ( $image = wp_get_attachment_image_url( $meta['attachment'], 'slider' ) ) {
                printf(
                    '<figure><img id="eul-slider-image" src="%s"></figure>',
                    esc_url( $image )
                );
            }

            printf(
                '<button id="eul-slider-choose" class="button button-primary button-large">%s</button>',
                __( 'Добавить постер', 'e-ul' )
            );

            printf(
                '<button id="eul-slider-remove" class="button button-large">%s</button>',
                __( 'Удалить', 'e-ul' )
            );

            printf(
                '<input id="eul-slider-attachment" type="hidden" name="%s[attachment]" value="%s">',
                esc_attr( self::$post_meta ),
                absint( $meta['attachment'] )
            );

            wp_nonce_field( 'save-metabox', 'eul-slider-metabox' );
        }


         /**
          * Save metabox options
          */
        public static function save_metabox( $post_id ) {
            if ( get_post_type( $post_id ) !== self::$post_type ) {
                return;
            }

            if ( ! isset( $_REQUEST['eul-slider-metabox'] ) ) {
                return;
            }

            if ( ! wp_verify_nonce( $_REQUEST['eul-slider-metabox'], 'save-metabox' ) ) {
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

                // Duplicate attachment as thumbnail
                if ( ! empty( $meta['attachment'] ) ) {
                    update_post_meta( $post_id, '_thumbnail_id', $meta['attachment'] );
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
    add_action( 'init', array( 'Eul_Slider', 'register' ) );
}