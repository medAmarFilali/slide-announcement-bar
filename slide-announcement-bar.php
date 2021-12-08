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

            require_once( ADA_SLIDE_BAR_PATH . 'post-types/class.ada-slide-bar_cpt.php' );
            $ada_slide_bar_post_type = new ADA_Slide_bar_post_type();

            require_once( ADA_SLIDE_BAR_PATH . 'class.ada-announcement-bar_view.php' );
            $mv_slider_bar_view = new ADA_Slider_Bar_view();

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



    }
}

if( class_exists( 'ADA_Slide_Bar' ) ){
    register_activation_hook( __FILE__ , array( 'ADA_Slide_Bar', 'activate' ) );
    register_deactivation_hook( __FILE__ , array( 'ADA_Slide_Bar', 'deactivate' ) );
    register_uninstall_hook( __FILE__ , array( 'ADA_Slide_Bar', 'uninstall' ) );
    $ada_slide_bar = new ADA_Slide_Bar();
}
