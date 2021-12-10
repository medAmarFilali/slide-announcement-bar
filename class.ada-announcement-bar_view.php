<?php

if ( ! class_exists( 'ADA_Slider_Bar_view' ) ){
    class ADA_Slider_Bar_view{
        public function __construct(){
            add_action( 'wp_body_open', array( $this, 'mv_slider_bar_render') );
        }

        public function mv_slider_bar_render(){
            $options = get_option( 'ada_slide_bar_options' );
            if( isset( $options['enable_home_only'] ) && $options['enable_home_only']  ){
                if( is_front_page() ){
                    ob_Start();
                    require( ADA_SLIDE_BAR_PATH . 'views/top-bar-slider.php' );
                    wp_enqueue_script( 'slick-main-js' );
                    wp_enqueue_script( 'slick-options-js' );
                    wp_enqueue_style( 'ada-main-style' );
                    wp_enqueue_style( 'slick-main-style' );
                    wp_enqueue_style( 'slick-theme-style' );
                    wp_localize_script( 'slick-options-js', 'slickOptions', array(
                        'autoplaySpeed' => ( isset( $options['ada_slide_bar_autoplay_speed'] ) ) ? $options['ada_slide_bar_autoplay_speed'] : 3000
                    ) );
                    echo ob_get_clean();        
                } else {
                    return;
                }
            } else {
                ob_Start();
                require( ADA_SLIDE_BAR_PATH . 'views/top-bar-slider.php' );
                wp_enqueue_script( 'slick-main-js' );
                wp_enqueue_script( 'slick-options-js' );
                wp_enqueue_style( 'ada-main-style' );
                wp_enqueue_style( 'slick-main-style' );
                wp_enqueue_style( 'slick-theme-style' );
                wp_localize_script( 'slick-options-js', 'slickOptions', array(
                    'autoplaySpeed' => ( isset( $options['ada_slide_bar_autoplay_speed'] ) ) ? $options['ada_slide_bar_autoplay_speed'] : 3000
                ) );
                echo ob_get_clean();
            }
        }
    }
}