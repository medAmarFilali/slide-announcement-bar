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

            require_once( ADA_SLIDE_BAR_PATH . 'post-types/class.ada-slide-bar_cpt.php' );
            $ada_slide_bar_post_type = new ADA_Slide_bar_post_type();
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



    }
}

if( class_exists( 'ADA_Slide_Bar' ) ){
    register_activation_hook( __FILE__ , array( 'ADA_Slide_Bar', 'activate' ) );
    register_deactivation_hook( __FILE__ , array( 'ADA_Slide_Bar', 'deactivate' ) );
    register_uninstall_hook( __FILE__ , array( 'ADA_Slide_Bar', 'uninstall' ) );
    $ada_slide_bar = new ADA_Slide_Bar();
}
