<?php

if ( ! class_exists( 'ADA_Slide_Bar_settings' ) ){
    class ADA_Slide_Bar_settings{
        public static $options;

        public function __construct(){
            self::$options = get_option( 'ada_slide_bar_options' );

            add_action( 'admin_init', array( $this, 'admin_init' ) );
        }

        public function admin_init(){
            register_setting( 'ada_slide_bar_group', 'ada_slide_bar_options', array( $this, 'ada_slide_bar_validate' ) );

            add_settings_section(
                'ada_slide_bar_main_section',
                esc_html__( 'Main settings', 'ada_slide_bar' ),
                null,
                'ada_slide_bar_main_page'
            );

            add_settings_field(
                'ada_slide_bar_enable',
                esc_html__( 'Enable top bar', 'ada_slide_bar' ),
                array( $this, 'ada_slide_bar_enable_callback' ),
                'ada_slide_bar_main_page',
                'ada_slide_bar_main_section',
                array(
                    'label_for' => 'ada_slide_bar_enable'
                )
            );

            add_settings_field(
                'ada_slide_bar_only_home_page',
                esc_html__( "Enable only on home page", 'ada_slide_bar' ),
                array( $this, 'ada_slide_bar_enable_home_callback' ),
                'ada_slide_bar_main_page',
                'ada_slide_bar_main_section',
                array(
                    'label_for' => 'enable_home_only'
                )
            );

            add_settings_field(
                'ada_slide_bar_style',
                esc_html__( 'Top bar style', 'ada_slide_bar' ),
                array( $this, 'ada_slide_bar_style_callback' ),
                'ada_slide_bar_main_page',
                'ada_slide_bar_main_section',
                array(
                    'items' => array(
                        'dark',
                        'light',
                        'retro',
                    ),
                    'label_for' => 'ada_slide_bar_style'
                )
            );

            add_settings_field(
                'ada_slider_bar_autoplay_speed',
                esc_html__( 'Autoplay speed', 'ada_slide_bar' ),
                array( $this, 'ada_slide_bar_autoplay_speed_callback' ), 
                'ada_slide_bar_main_page',
                'ada_slide_bar_main_section'
            );

        }

        public function ada_slide_bar_enable_callback( $args ){
            ?>
                <input 
                    type="checkbox" 
                    name="ada_slide_bar_options[enable_top_bar]" 
                    id="ada_slide_bar_enable" 
                    value="1"
                    <?php
                        if( isset( self::$options['enable_top_bar'] ) ){
                            checked( '1', self::$options['enable_top_bar'], true );
                        }
                    ?>
                />
            <?php
        }

        public function ada_slide_bar_enable_home_callback(){
            ?>
                <input 
                    type="checkbox"
                    name="ada_slide_bar_options[enable_home_only]"
                    id="enable_home_only"
                    value="1"
                    <?php
                        if( isset( self::$options['enable_home_only'] ) ){
                            checked( '1', self::$options['enable_home_only'], true );
                        }
                    ?>
                />
            <?php
        }

        // REMINDER: FIX the first option selected on refresh
        public function ada_slide_bar_style_callback( $args ){
            ?>
                <select name="ada_slide_bar_options[ada_slide_bar_style]" id="ada_slide_bar_style">
                    <?php
                        foreach( $args['items'] as $item ){
                            var_dump($args);
                            ?>
                                <option value="<?php echo esc_attr($item) ?>" <?php ( isset( self::$options['ada_top_bar_style'] ) ) ? selected( $item, self::$options['ada_top_bar_style'], true ) : 'Dark' ?>  >
                                <?php echo esc_html( ucfirst($item) ); ?>
                                </option>
                            <?php
                        }
                    ?>
                </select>
            <?php 
        }

        public function ada_slide_bar_autoplay_speed_callback(){
            ?>
                <div class='range-slider'>
                    <input 
                        type="range" 
                        name="ada_slide_bar_options[ada_slide_bar_autoplay_speed]" 
                        id="ada_slide_bar_autoplay_speed" 
                        value="<?php echo ( isset( self::$options['ada_slide_bar_autoplay_speed'] ) ) ? self::$options['ada_slide_bar_autoplay_speed'] : '3000' ?>" 
                        min="1000" 
                        max="20000" 
                        step="1000" 
                        />
                    <span id="ada_slide_bar_autoplay_speed_value"><?php echo ( isset( self::$options['ada_slide_bar_autoplay_speed'] ) ) ? esc_html(self::$options['ada_slide_bar_autoplay_speed'] / 1000 . __(" seconds", 'ada_slide_bar')) : __('3 seconds', 'ada_slide_bar') ?></span>
                </div>
            <?php
        }



        public function ada_slide_bar_validate( $input ){
            $new_input = array();
            foreach( $input as $key => $value ){
                $new_input[$key] = sanitize_text_field($value);
            }
            return $new_input;
        }

    }
}