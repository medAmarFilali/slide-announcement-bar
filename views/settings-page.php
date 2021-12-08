<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
        <?php
            settings_fields( 'ada_slide_bar_group' );
            do_settings_sections( 'ada_slide_bar_main_page' );

            submit_button( esc_html__( 'Save settings', 'ada_slide_bar' ) );
        ?>
        
    </form>
</div>