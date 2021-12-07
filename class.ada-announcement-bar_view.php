<?php

if ( ! class_exists( 'ADA_Slider_Bar_view' ) ){
    class ADA_Slider_Bar_view{
        public function __construct(){
            add_action( 'wp_body_open', array( $this, 'mv_slider_bar_render') );
        }

        public function mv_slider_bar_render(){
            ob_Start();
            require( ADA_SLIDE_BAR_PATH . 'views/top-bar-slider.php' );
            wp_enqueue_style( 'ada-main-style' ) ;
            echo ob_get_clean();
        }
    }
}