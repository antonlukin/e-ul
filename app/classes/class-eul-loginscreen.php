<?php
/**
 * Login screen styles handler
 *
 * @package e-ul
 * @since 1.2
 */

if ( ! class_exists( 'Eul_Loginscreen' ) ) {
    /**
     * Login screen styles handler
     */
    class Eul_Loginscreen {
        /**
         * Static method instead of construct
         */
        public static function register() {
            // Update login header url
            add_action( 'login_headerurl', array( __CLASS__, 'change_url' ) );

            // Update login header text
            add_action( 'login_headertext', array( __CLASS__, 'change_title' ) );

            // Update admin styles
            add_action( 'login_enqueue_scripts', array( __CLASS__, 'login_styles' ) );
        }


        /**
         * Update login header url
         */
        public static function change_url( $login_url ) {
            $login_url = home_url( '/' );

            return $login_url;
        }


        /**
         * Update login header text
         */
        public static function change_title( $login_title ) {
            $login_title = __( 'На главную', 'e-ul' );

            return $login_title;
        }


        /**
         * Print custom styles with custom logo
         */
        public static function login_styles() {
            $version = wp_get_theme()->get('Version');
            $include = get_template_directory_uri() . '/assets/admin';

            wp_enqueue_style( 'eul-login-screen', $include . '/login-screen.css', array(), $version );
        }
    }


    /**
     * Start class
     */
    add_action( 'init', array( 'Eul_Loginscreen', 'register' ) );
}