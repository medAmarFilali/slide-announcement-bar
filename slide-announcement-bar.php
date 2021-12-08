<?php

/**
 * Plugin Name: Slide Annoucement bar
 * Plugin URI: https://adastra-creative.com
 * Description: Displays an announcement bar on top of the header section
 * Version: 1.0
 * Requires at least: 5.6
 * Author: Amar Filali
 * Author URI: https://amarfilali.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ada-slide-bar
 * Domain Path: /languages
 */

if( ! defined( 'ABSPATH' ) ){
    die( "This is just a wordpress plugin" );
    exit;
}

if( ! class_exists( 'ADA_Slide_Bar' ) ){
    class ADA_Slide_Bar{
        function __construct(){
            $this->define_constants();

            add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );

            add_action( 'admin_menu', array( $this, 'admin_menu' ) );

            require_once( ADA_SLIDE_BAR_PATH . 'class.ada-announcement-bar_settings.php' );
            $ada_slide_bar_settings = new ADA_Slide_bar_settings();

            require_once( ADA_SLIDE_BAR_PATH . 'post-types/class.ada-slide-bar_cpt.php' );
            $ada_slide_bar_post_type = new ADA_Slide_bar_post_type();

            require_once( ADA_SLIDE_BAR_PATH . 'class.ada-announcement-bar_view.php' );
            $mv_slider_bar_view = new ADA_Slider_Bar_view();

            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

        }

        public function define_constants(){
            define( 'ADA_SLIDE_BAR_PATH', plugin_dir_path( __FILE__ ) );
            define( 'ADA_SLIDE_BAR_URL', plugin_dir_url( __FILE__ ) );
            define( 'ADA_SLIDE_BAR_VERSION', '1.0.0' );
        }

        public static function activate(){
            update_option( 'rewrite_rules', '');
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type( 'ada-announcement' );
        }

        public static function uninstall(){

        }

        public function register_scripts(){
            wp_register_script( 'slick-main-js', ADA_SLIDE_BAR_URL . 'vendor/slick/slick.min.js', array( 'jquery' ), ADA_SLIDE_BAR_VERSION, true );
            wp_register_script( 'slick-options-js', ADA_SLIDE_BAR_URL . 'vendor/slick/slick.js', array( 'jquery' ), ADA_SLIDE_BAR_VERSION, true );
            wp_register_style( 'ada-main-style', ADA_SLIDE_BAR_URL . 'assets/css/top-bar-slider.css', array(), ADA_SLIDE_BAR_VERSION, 'all' );
            wp_register_style( 'slick-main-style', ADA_SLIDE_BAR_URL . 'vendor/slick/slick.css', array(), ADA_SLIDE_BAR_VERSION, 'all' );
            wp_register_style( 'slick-theme-style', ADA_SLIDE_BAR_URL . 'vendor/slick/slick-theme.css', array(), ADA_SLIDE_BAR_VERSION, 'all' );

        }

        public function admin_menu() {
            add_menu_page(
                esc_html__( 'Annoucement bar options', 'ada_slide_bar' ),
                esc_html__( 'Announcement Bar Options', 'ada_slide_bar' ),
                'manage_options',
                'ada_slide_bar',
                array( $this, 'ada_slide_bar_settings_page' ),
                'dashicons-align-wide'
            );

            add_submenu_page(
                'ada_slide_bar',
                esc_html__( 'Manage annoucements', 'ada_slide_bar' ),
                esc_html__( 'Manage annoucements', 'ada_slide_bar' ),
                'manage_options',
                'edit.php?post_type=ada-announcement',
                null, 
                null
            );

        }

        public function ada_slide_bar_settings_page(){
            if( ! current_user_can( 'manage_options' ) ){
                return;
            }        
            require( ADA_SLIDE_BAR_PATH . 'views/settings-page.php' );
        }

        public function admin_enqueue_scripts( $hook_suffix ){
            echo $hook_suffix;
            if( $hook_suffix == 'toplevel_page_ada_slide_bar' ){
                wp_enqueue_style( 'ada-slide-bar-style', ADA_SLIDE_BAR_URL . 'assets/css/admin.css', array(), ADA_SLIDE_BAR_VERSION, 'all' );
                wp_enqueue_script( 'ada-slide-bar-script', ADA_SLIDE_BAR_URL . 'assets/js/admin.js', array(), ADA_SLIDE_BAR_VERSION, true );
            }
        }



    }
}

if( class_exists( 'ADA_Slide_Bar' ) ){
    register_activation_hook( __FILE__ , array( 'ADA_Slide_Bar', 'activate' ) );
    register_deactivation_hook( __FILE__ , array( 'ADA_Slide_Bar', 'deactivate' ) );
    register_uninstall_hook( __FILE__ , array( 'ADA_Slide_Bar', 'uninstall' ) );
    $ada_slide_bar = new ADA_Slide_Bar();
}
