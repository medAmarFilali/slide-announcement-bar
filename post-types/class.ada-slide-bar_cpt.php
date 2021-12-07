<?php
if( ! class_exists( 'ADA_Slide_Bar_post_type' ) ){
    class ADA_Slide_Bar_post_type{
        function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
        }

        public function create_post_type(){
            register_post_type('ada-announcement', array(
                'label' => esc_html__('Announcement', 'ada-slide-bar'),
                'description' => esc_html__('Announcements to view on top of the header section', 'ada-slide-bar'),
                'labels' => array(
                    'name' => esc_html__('Announcements', 'ada-slide-bar'),
                    'singular_name' => esc_html__('Announcement', 'ada-slide-bar')
                ),
                'public' => false,
                'supports' => array('title'),
                'hierarchical' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_admin_bar' => true,
                'show_in_nav_menus' => true,
                'can_export' => true,
                'has_archive' => false,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'show_in_rest' => true,
                'menu_icon' => 'dashicons-minus',
            ));
        }

    }
}