<?php
    $options = get_option('ada_slide_bar_options');
?>

<div class="slick-slider <?php echo $options['ada_slide_bar_style']; ?> ">
        <?php
            $count = 0;
            $args = array(
                'post_type' => 'ada-announcement',
                'post_status' => 'publish',
                'order_by' => 'date'
            );

            $query = new WP_Query($args);

            if( $query->have_posts() ) :
                while( $query->have_posts() ) : $query->the_post();
        ?>
        <div class="announcement-wrapper">
            <p><?php the_title(); ?></p>
        </div>

        <?php
                endwhile;
                wp_reset_postdata();
            endif;
        ?>
</div>